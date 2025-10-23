<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QRCode Aset BBPP Binuang</title>
    <style>
        #preview {
            transform: scaleX(1) !important;
            width: 100%;
            height: 30vh;
            object-fit: cover;
            border-radius: 10px;


        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body style="color: green;">
    <div class="d-flex align-items-center justify-content-center mt-2">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/54/Logo_of_Ministry_of_Agriculture_of_the_Republic_of_Indonesia.svg/2072px-Logo_of_Ministry_of_Agriculture_of_the_Republic_of_Indonesia.svg.png"
            alt="Logo" width="40px" class="me-2">
        <span class="black-white fw-bold" style="position:relative; top:-4px;font-size:20px;">BBPP BINUANG</span>
    </div>

    <div class="container py-3">
        <div class="card p-3 shadow">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <h4 class="mb-0" style="font-size:15px;">
                    Scan QR Code Aset
                    <button class="btn btn-sm btn-outline-primary ms-2" onclick="refreshScanner()">
                        <i class="fa-solid fa-rotate-right"></i>
                    </button>
                </h4>
            </div>
            <video id="preview" style="width:100%;border-radius:8px;"></video>
        </div>

        <div class="mt-4">
            <h5>Data Aset</h5>
            <table class="table table-bordered">
                <tbody id="asset-data">
                    <tr>
                        <td colspan="2" class="text-center text-muted">Belum ada data</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ Instascan -->
    <script src="https://cdn.jsdelivr.net/gh/schmich/instascan-builds@master/instascan.min.js"></script>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });

        scanner.addListener('scan', function(content) {
            fetch(`/get-asset/${content}`)
                .then(res => res.json())
                .then(data => {
                    let tbody = document.getElementById("asset-data");
                    tbody.innerHTML = "";

                    if (data.error) {
                        tbody.innerHTML = `<tr><td colspan="2" class="text-danger">${data.error}</td></tr>`;
                        return;
                    }

                    tbody.innerHTML = `
          <tr><th>Nama</th><td>${data.nama}</td></tr>
          <tr><th>Kode</th><td>${data.uuid}</td></tr>
          <tr><th>Spesifikasi</th><td>${data.spesifikasi}</td></tr>
          <tr><th>Lokasi</th><td>${data.lokasi}</td></tr>
          <tr><th>Status</th><td>${data.status}</td></tr>
          <tr><th>Catatan</th><td>${data.catatan}</td></tr>
          <tr><th>Tim Kerja</th><td>${data.team}</td></tr>
          <tr><th>Ditambahkan</th><td>${data.created_at}</td></tr>
        `;
                })
                .catch(err => {
                    console.error(err);
                    alert("❌ Gagal mengambil data aset!");
                });
        });

        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[cameras.length - 1]);
            } else {
                alert('⚠️ Tidak ada kamera terdeteksi');
            }
        }).catch(function(e) {
            console.error(e);
            alert("❌ Error akses kamera: " + e);
        });

        function refreshScanner() {
            location.reload();
        }
    </script>
</body>

</html>