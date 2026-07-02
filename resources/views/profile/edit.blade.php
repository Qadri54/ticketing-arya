<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pengaturan Profil - TICKS ID</title>

    <style>
        /* Pengaturan Warna dan Font Dasar */
        :root {
            --primary: #2563eb; /* Warna biru utama */
            --danger: #dc2626; /* Warna merah untuk hapus akun */
            --bg-color: #f3f4f6; /* Warna latar abu-abu lembut */
            --card-bg: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            padding: 0;
        }

        /* Desain Navigasi Atas */
        .navbar {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 0 20px;
            height: 64px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .brand {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--primary);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .btn-back {
            background-color: var(--bg-color);
            color: #374151;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            transition: 0.2s;
            border: 1px solid var(--border-color);
        }

        .btn-back:hover {
            background-color: #e5e7eb;
        }

        /* Desain Wadah Konten Tengah */
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h2 {
            margin: 0 0 5px 0;
            font-size: 2rem;
            font-weight: 800;
        }

        .page-header p {
            margin: 0;
            color: var(--text-muted);
        }

        /* Desain Kotak / Card */
        .card {
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        /* Garis Pita di Pinggir Kiri Kotak */
        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: var(--primary);
        }

        .card.danger::before {
            background-color: var(--danger);
        }

        .card-header {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.25rem;
            color: #1f2937;
        }

        .card.danger .card-header h3 {
            color: var(--danger);
        }

        /* Memperbaiki tampilan form bawaan Laravel Breeze dengan CSS murni */
        .card input[type="text"], 
        .card input[type="email"], 
        .card input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box;
            font-family: inherit;
        }

        .card input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
        }

        .card label {
            font-weight: 600;
            font-size: 0.875rem;
            color: #374151;
        }

        .card button {
            background-color: #1f2937;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 10px;
        }

        .card button:hover {
            background-color: #374151;
        }

        .card.danger button {
            background-color: var(--danger);
        }

        .card.danger button:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="brand">TICKS ID</a>
        <a href="{{ url('/') }}" class="btn-back">&larr; Kembali</a>
    </nav>

    <main class="container">
        
        <div class="page-header">
            <h2>Pengaturan Akun</h2>
            <p>Kelola informasi pribadi dan keamanan kata sandi Anda di sini.</p>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Informasi Pribadi</h3>
            </div>
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Keamanan Kata Sandi</h3>
            </div>
            @include('profile.partials.update-password-form')
        </div>

        <div class="card danger">
            <div class="card-header">
                <h3>Hapus Akun</h3>
            </div>
            @include('profile.partials.delete-user-form')
        </div>

    </main>

</body>
</html>