<!DOCTYPE html>
<html>
<head>
    <title>Detail Aset QRCode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .card {
            background: white;
            display: inline-block;
            padding: 20px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .qrcode {
            margin-bottom: 20px;
        }
        h2 {
            margin: 10px 0;
            color: #333;
        }
        p {
            margin: 5px 0;
            color: #555;
        }
        .status {
            font-weight: bold;
            color: green;
        }
        .status.rusak {
            color: red;
        }
        .print-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .print-btn:hover {
            background: #0056b3;
        }

        /* === Cetak hanya QRCode + border === */
        @media print {
            body * {
                visibility: hidden; /* sembunyikan semua */
            }
            .qrcode, .qrcode * {
                visibility: visible; /* hanya QR tampil */
            }
            .qrcode {
                border: 5px solid #000; /* border hitam */
                padding: 15px;
                margin: auto;
                display: inline-block;
            }
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="qrcode">
            {!! QrCode::size(200)->generate($url) !!}
        </div>

        <h2>{{ $asset->nama }}</h2>
        <p><strong>Spesifikasi:</strong> {{ $asset->spesifikasi }}</p>
        <p><strong>Lokasi:</strong> {{ $asset->lokasi }}</p>
        <p><strong>Tim Kerja:</strong> {{ $asset->team->nama ?? '-' }}</p>
        <p class="status {{ $asset->status == 'rusak' ? 'rusak' : '' }}">
            <strong>Status:</strong> {{ ucfirst($asset->status) }}
        </p>
        <p><strong>Catatan:</strong> {{ $asset->catatan ?? '-' }}</p>

        <button class="print-btn" onclick="window.print()">🖨 Cetak</button>
    </div>

</body>
</html>
