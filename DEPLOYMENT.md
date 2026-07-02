# Deployment — TICKS ID (ticketing-arya)

> Dokumentasi deployment produksi di server `103.93.134.128`, domain **https://ticketing-arya.web.id**. Dikerjakan 3 Juli 2026.

---

## 1. Topologi Server

Server ini (RAM 2 GB, 1 vCPU) menjalankan beberapa project Docker di `/var/www/`. Port 80/443 host **hanya** dipegang oleh satu front reverse proxy: `ich-pendidikan-nginx-1` (project ICH-Pendidikan). Project lain tidak boleh bind port ke host — traffic masuk per domain lewat front proxy, yang bergabung ke docker network masing-masing project.

```
Internet ──▶ ich-pendidikan-nginx-1 (host :80/:443)
                 │  vhost: ich-pendidikantk.online      → app ICH (php-fpm)
                 │  vhost: ticketing-arya.web.id        → ticketing_arya_nginx:80
                 │  vhost: maturitasdigital.site        → banksumut_nginx:80   (nonaktif)
                 │  vhost: wa-notification....online    → wa-server-app-1:3000 (nonaktif)
                 ▼
        ticketing_arya_nginx ──▶ ticketing_arya_app (php-fpm :9000)
                                          │
                                 ticketing_arya_mysql (MySQL 8, db: ticketing_mitra)
```

**Port terpakai di host (jangan ditabrak): 22 (SSH), 80/443 (front proxy), 7800 (proses `webserver` host).**

## 2. SSH Deploy Key GitHub

Key khusus project ini (bukan key akun pribadi):

- Private key: `~/.ssh/ticketing-arya_deploy` (ed25519)
- Public key: `~/.ssh/ticketing-arya_deploy.pub` — didaftarkan sebagai **Deploy Key** di repo `Qadri54/ticketing-arya`
- Alias SSH di `~/.ssh/config`:

```
Host github.com-ticketing-arya
    HostName github.com
    User git
    IdentityFile ~/.ssh/ticketing-arya_deploy
    IdentitiesOnly yes
```

- Remote origin: `git@github.com-ticketing-arya:Qadri54/ticketing-arya.git`

## 3. Stack Docker

Empat service (lihat `docker-compose.yml`):

| Container | Image | Peran |
|---|---|---|
| `ticketing_arya_app` | build `Dockerfile` (php:8.2-fpm) | Laravel 9; ekstensi: pdo_mysql, gd, intl, zip, bcmath, opcache, dll; composer install + `npm run build` (Vite) saat build image |
| `ticketing_arya_nginx` | nginx:1.27-alpine | Web server internal, **tanpa port host**; conf: `docker/nginx/default.conf` |
| `ticketing_arya_mysql` | mysql:8.0 | Database `ticketing_mitra`; data di volume `mysql_data` |
| `ticketing_arya_certbot` | certbot/certbot | Loop `certbot renew` tiap 12 jam |

Volume penting: `storage_public` (poster event), `mysql_data`, `certbot_conf` (sertifikat), `certbot_www` (webroot ACME), `public_build` (hasil Vite).

`.env` produksi berada di root project (di-gitignore), di-mount **read-only** ke container. `APP_KEY` sudah di-generate; migrasi database sudah dijalankan (18 migration).

## 4. Integrasi Front Proxy & SSL

Perubahan pada project ICH-Pendidikan (backup: `*.bak-20260703`):

1. `docker/nginx/default.conf` — tambah vhost `ticketing-arya.web.id`: port 80 redirect ke HTTPS (kecuali ACME challenge), port 443 SSL → proxy ke `ticketing_arya_nginx:80`.
2. `docker-compose.yml` — front nginx join network eksternal `ticketing-arya_ticketing_net` dan mount volume cert `ticketing-arya_certbot_conf` sebagai `/etc/letsencrypt-ticketing:ro`.
3. Semua `proxy_pass` ke upstream yang bisa mati memakai pola **lazy resolution** (`resolver 127.0.0.11` + variabel) agar nginx tetap bisa start/reload walau container tujuan mati.

Sertifikat: Let's Encrypt via webroot challenge, berlaku s/d **30 Sep 2026**, auto-renew oleh `ticketing_arya_certbot`.

Penerbitan manual (bila perlu):
```bash
docker compose run --rm --entrypoint certbot certbot certonly \
  --webroot -w /var/www/certbot -d ticketing-arya.web.id \
  --email alifa.qadri@gmail.com --agree-tos --no-eff-email --non-interactive
```
> Catatan: `--entrypoint certbot` wajib, karena service certbot punya entrypoint loop renew.

## 5. Manajemen Resource

Karena RAM hanya 2 GB (pernah OOM saat build), project berikut **dimatikan permanen** (`docker stop` + `docker update --restart=no`): Maturitas_Digital_BankSumut, englishICH, mariska_adversting, wa-server. Yang hidup: ICH-Pendidikan (front proxy + app-nya) dan ticketing-arya.

Menghidupkan kembali sebuah project:
```bash
docker update --restart=unless-stopped <container...>
docker start <container...>
```

## 6. Operasional Sehari-hari

```bash
# Deploy update kode
cd /var/www/ticketing-arya
git pull
docker compose build && docker compose up -d
docker exec ticketing_arya_app php artisan migrate --force
docker exec ticketing_arya_app chown -R www-data:www-data storage

# Log aplikasi
docker exec ticketing_arya_app tail -50 storage/logs/laravel.log

# Setelah mengubah .env — WAJIB recreate, bukan restart
docker compose up -d --force-recreate app
```

### Jebakan yang sudah ditemukan (jangan diulang)

1. **`.env` di-mount single-file**: editor/`sed -i` mengganti inode → container masih membaca file lama. Solusi: `--force-recreate app` setiap habis edit `.env`.
2. **Permission `.env`**: harus `644` — php-fpm jalan sebagai `www-data`, kalau `640` milik user host, web request 500 `MissingAppKeyException` padahal CLI normal.
3. **`docker exec ... php artisan` jalan sebagai root** → file log/cache jadi milik root dan web tidak bisa menulis. Selalu `chown -R www-data:www-data storage` sesudahnya.
4. **JANGAN `php artisan config:cache`** — `CheckoutController` membaca `env('MIDTRANS_SERVER_KEY')` langsung; dengan config cache, `env()` mengembalikan null dan pembayaran mati.
5. **Ubah conf front nginx**: selalu `docker exec ich-pendidikan-nginx-1 nginx -t` sebelum `nginx -s reload`.

## 7. Yang Belum / Perlu Tindak Lanjut

- [ ] Isi `MIDTRANS_SERVER_KEY` & `MIDTRANS_CLIENT_KEY` (sandbox) di `.env` → tanpa ini checkout berbayar gagal.
- [ ] Isi kredensial `MAIL_*` di `.env` → tanpa ini email e-ticket gagal terkirim.
- [ ] Midtrans masih hardcode sandbox (`isProduction = false` di `CheckoutController`); `config/midtrans.php` sudah disiapkan (env `MIDTRANS_IS_PRODUCTION`) tapi controller belum membacanya.
- [ ] Route debug berisiko di produksi: `/debug-paid/{id}`, `/test-email-qr`, `/tes-langsung` (lihat `architecture.md` §11) — sebaiknya dihapus.
- [ ] DNS `www.ticketing-arya.web.id` belum ada; kalau dibuat, terbitkan ulang cert dengan `-d` tambahan.
