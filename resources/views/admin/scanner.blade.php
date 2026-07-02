<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in Scanner - TICKS ID</title>
    <!-- Tailwind CSS untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Agar tampilan kamera rapi */
        #reader { width: 100%; border-radius: 12px; overflow: hidden; border: none; }
        #reader__scan_region img { object-fit: cover; }
    </style>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4 font-sans text-gray-800">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="bg-[#1c1e54] text-white p-4 text-center">
            <h1 class="text-xl font-semibold">Scanner Panitia</h1>
            <p class="text-sm opacity-80">Arahkan kamera ke QR Code tiket</p>
        </div>

        <!-- Area Kamera -->
        <div class="p-4">
            <div id="reader" class="shadow-inner"></div>

            <!-- Tempat memunculkan pesan sukses/error -->
            <div id="result-box" class="mt-4 p-4 rounded-lg hidden text-center font-medium"></div>

            <div class="mt-6 text-center">
                <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:underline">Kembali ke Dashboard Admin</a>
            </div>
        </div>
    </div>

    <!-- Library Javascript HTML5-QRCode -->
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        // Setup Token keamanan Laravel (Wajib untuk request POST)
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const resultBox = document.getElementById('result-box');

        // Mencegah scan berulang kali dalam 1 detik yang sama (debounce)
        let isScanning = false;

        function onScanSuccess(decodedText, decodedResult) {
            if(isScanning) return;
            isScanning = true;

            // Beri tahu panitia sedang loading
            resultBox.className = "mt-4 p-4 rounded-lg text-center font-medium bg-blue-100 text-blue-700 block";
            resultBox.innerHTML = "Mengecek tiket...";

            // Mengirim data ke CheckInController@process
            fetch('/check-in-process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ order_id: decodedText }) // Mengirim teks hasil scan (order_id)
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Jika sukses (hijau)
                    resultBox.className = "mt-4 p-4 rounded-lg text-center font-medium bg-green-100 text-green-700 block";
                    resultBox.innerHTML = `✅ ${data.message}<br><small>Nama: ${data.participant_name}</small>`;
                } else {
                    // Jika gagal (merah)
                    resultBox.className = "mt-4 p-4 rounded-lg text-center font-medium bg-red-100 text-red-700 block";
                    resultBox.innerHTML = `❌ ${data.message}`;
                }

                // Jeda 3 detik sebelum bisa scan tiket orang berikutnya
                setTimeout(() => {
                    isScanning = false;
                    resultBox.classList.add('hidden'); // Sembunyikan kotak pesan
                }, 3000);
            })
            .catch(error => {
                console.error('Error:', error);
                isScanning = false;
            });
        }

        // Inisialisasi Kamera
        let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
            fps: 10,
            qrbox: {width: 250, height: 250},
            supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
        });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>
