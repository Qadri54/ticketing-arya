<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Ticket TICKS ID</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #e3e8ee;
            margin: 0;
            padding: 40px 20px;
        }
        /* Pembungkus utama tiket */
        .ticket-box {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 0; vertical-align: top; }

        /* Area Hitam di Dalam Tiket Utama */
        .black-box {
            background-color: #111111;
            color: #ffffff;
            border-radius: 8px;
            padding: 20px;
        }
        .event-title {
            font-size: 28px;
            font-weight: 900;
            text-transform: uppercase;
            margin: 0 0 15px 0;
            letter-spacing: 1px;
        }

        /* Area Sobekan Kanan (Stub) */
        .stub-area {
            background-color: #ffffff;
            width: 30%;
            text-align: center;
            border-left: 4px dashed #bdc3c7;
            padding: 30px 20px;
        }

        /* Kunci untuk Multi-Halaman */
        .page-break { page-break-after: always; padding-bottom: 30px; }
        .page-break:last-child { page-break-after: auto; }
    </style>
</head>
<body>

    @foreach($transaction->tickets as $index => $ticket)

    @php
        // RUMUS WARNA DINAMIS: Beda ID Event = Beda Warna Tema
        $colorPalette = ['#F3A712', '#E74C3C', '#3498DB', '#9B59B6', '#1ABC9C', '#E67E22'];
        $themeColor = $colorPalette[$transaction->event_id % count($colorPalette)];
    @endphp

    <div class="page-break">
        <div class="ticket-box">
            <table>
                <tr>
                    <td style="background-color: {{ $themeColor }}; width: 70%; padding: 25px;">

                        <div class="black-box">
                            <h1 class="event-title">{{ $transaction->event->name }}</h1>

                            <table>
                                <tr>
                                    <td style="width: 75%;">
                                        <p style="color: {{ $themeColor }}; font-size: 11px; font-weight: bold; margin: 0; text-transform: uppercase;">Waktu Penyelenggaraan</p>
                                        <p style="margin: 5px 0 0; font-size: 16px; font-weight: bold;">
                                            {{ date('d M Y', strtotime($transaction->event->event_date)) }} | {{ date('H:i', strtotime($transaction->event->event_date)) }} WIB
                                        </p>

                                        <p style="color: {{ $themeColor }}; font-size: 11px; font-weight: bold; margin: 15px 0 0; text-transform: uppercase;">Lokasi Event</p>
                                        <p style="margin: 5px 0 0; font-size: 14px;">{{ $transaction->event->location }}</p>
                                    </td>
                                    <td style="width: 25%; text-align: right; vertical-align: bottom;">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=70x70&data={{ $ticket->ticket_code }}&color=ffffff&bgcolor=111111" width="70" height="70" alt="QR Small">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <table style="width: 100%; margin-top: 20px; color: #111111; font-weight: 900; font-size: 14px;">
                            <tr>
                                <td>
                                    <span style="font-size: 11px; font-weight: bold; color: rgba(0,0,0,0.6); display: block;">PEMESAN</span>
                                    {{ strtoupper($transaction->user->name ?? 'PENGUNJUNG') }}
                                </td>
                                <td style="text-align: center;">
                                    <span style="font-size: 11px; font-weight: bold; color: rgba(0,0,0,0.6); display: block;">KATEGORI</span>
                                    {{ strtoupper($transaction->event->category) }}
                                </td>
                                <td style="text-align: right;">
                                    <span style="font-size: 11px; font-weight: bold; color: rgba(0,0,0,0.6); display: block;">STATUS</span>
                                    LUNAS
                                </td>
                            </tr>
                        </table>

                    </td>

                    <td class="stub-area">
                        <p style="font-weight: 900; font-size: 16px; margin: 0 0 5px 0; color: #111;">TANDA MASUK</p>
                        <p style="font-size: 11px; color: #7f8c8d; margin: 0 0 20px 0;">TIKET {{ $index + 1 }} DARI {{ $transaction->quantity }}</p>

                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data={{ $ticket->ticket_code }}&color=111111" width="130" height="130" alt="QR Scan">

                        <p style="font-weight: bold; font-size: 14px; letter-spacing: 1px; color: #111; margin: 15px 0 0;">
                            {{ $ticket->ticket_code }}
                        </p>
                        <p style="font-size: 10px; color: #bdc3c7; margin-top: 25px;">
                            TICKS ID &copy; {{ date('Y') }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @endforeach

</body>
</html>
