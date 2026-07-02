<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket - {{ $transaction->order_id }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #0D1B3E; }
        .ticket-box {
            border: 2px dashed #6C3FC5;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            margin: auto;
        }
        .header { text-align: center; border-bottom: 2px solid #F1F5F9; padding-bottom: 10px; margin-bottom: 20px; }
        .brand { font-size: 24px; font-weight: bold; color: #6C3FC5; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 12px; }
        .label { font-weight: bold; color: #64748b; font-size: 12px; }
        .value { font-weight: 600; color: #0D1B3E; font-size: 14px; }
        .qr-section { text-align: center; margin-top: 30px; }
    </style>
</head>
<body>

    <div class="ticket-box">
        <div class="header">
            <div class="brand">Arcomm Ticketing</div>
            <p>E-Ticket Resmi</p>
        </div>

        <div class="info-row">
            <span class="label">EVENT:</span>
            <span class="value">{{ $transaction->event->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">PEMESAN:</span>
            <span class="value">{{ $transaction->user->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">TANGGAL:</span>
            <span class="value">{{ date('d M Y', strtotime($transaction->event->event_date)) }}</span>
        </div>
        <div class="info-row">
            <span class="label">JUMLAH TIKET:</span>
            <span class="value">{{ $transaction->quantity }} Tiket</span>
        </div>
        <div class="info-row">
            <span class="label">ORDER ID:</span>
            <span class="value">{{ $transaction->order_id }}</span>
        </div>

        {{-- Ganti bagian qr-section dengan kode ini --}}
        {{-- Mengubah format menjadi svg agar tidak butuh Imagick --}}
        <div class="qr-section">
            <p style="font-size: 10px; color: #94a3b8; margin-bottom: 10px;">Scan kode di bawah saat registrasi</p>

            {{-- Kita pakai format('svg') karena library ini tidak butuh Imagick untuk SVG --}}
            <div style="width: 150px; margin: auto;">
                {!! QrCode::format('svg')->size(150)->generate($transaction->order_id) !!}
            </div>
        </div>
    </div>

</body>
</html>
