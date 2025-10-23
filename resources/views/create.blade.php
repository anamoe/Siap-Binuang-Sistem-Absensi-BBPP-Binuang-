@extends('main')
@section('title', 'Tambah Pemuda')
@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row mb-5">
        <h2 class="text-success mb-4 text-center fw-bold p-1" style="font-family: 'Times New Roman', Times, serif">Data Pemuda Kabupaten Banyuwangi</h2>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #508C9B;">
                    <a href="" class="card-title mt-2 text-white text-decoration-none h5"><i class="fa-solid fa-arrow-left"></i> Tambah Data Pemuda</a>
                </div>
                <div class="card-body">
                    <!-- Form untuk menambah data pemuda -->
                    <form action="" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK" required>
                                    @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="no_kk" class="form-label">No. KK</label>
                                    <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk" value="{{ old('no_kk') }}" placeholder="Masukkan No. KK (Opsional)">
                                    @error('no_kk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Lengkap" required>
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukkan Tempat Lahir" required>
                                    @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                    @error('tgl_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="agama" class="form-label">Agama</label>
                                    <select id="agama" class="form-select form-control @error('agama') is-invalid @enderror" name="agama">
                                      <option value="Islam">Islam</option>
                                      <option value="Kristen">Kristen</option>
                                      <option value="Katholik">Katolik</option>
                                      <option value="Buddha">Buddha</option>
                                      <option value="khonghucu">khonghucu</option>
                                    </select>
                                    @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> 
                                <div class="mb-3">
                                    <label for="no_telp" class="form-label">No. Telp</label>
                                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" value="{{ old('no_telp') }}" placeholder="Masukkan No. Telepon" required>
                                    @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3" hidden>
                                    <label for="umur" class="form-label">Umur</label>
                                    <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" id="umur" value="{{ old('umur') }}" placeholder="Masukkan Umur" readonly required>
                                    @error('umur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" class="form-select form-control @error('gender') is-invalid @enderror" name="gender">
                                      <option value="Laki-laki">Laki-laki</option>
                                      <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" class="form-select form-control @error('status') is-invalid @enderror" name="status">
                                      <option value="Belum Menikah">Belum Menikah</option>
                                      <option value="Sudah Menikah">Sudah Menikah</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pendidikan" class="form-label">Pendidikan</label>
                                    <select id="pendidikan" class="form-select form-control @error('pendidikan') is-invalid @enderror" name="pendidikan">
                                      <option value="SMP">SMP</option>
                                      <option value="SMA">SMA</option>
                                      <option value="S1">S1</option>
                                    </select>
                                    @error('pendidikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="Masukkan Pekerjaan (Opsional)">
                                    @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <select class="form-select @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan">
                                        <option disabled selected>Pilih Kecamatan</option>
                                       
                                    </select>
                                    @error('kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="desa" class="form-label">Desa</label>
                                    <select class="form-select @error('desa') is-invalid @enderror" id="desa" name="desa">
                                        <option disabled selected>Pilih Desa</option>
                                    </select>
                                    @error('desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" placeholder="Masukkan Alamat Lengkap" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex" style="float:right">
                            <button type="submit" class="btn btn-success">Tambah</button>
                            <a href="" class="btn btn-danger ms-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script AJAX untuk load desa berdasarkan kecamatan -->
<script>
    document.getElementById('kecamatan').addEventListener('change', function () {
    const kecamatanName = this.options[this.selectedIndex].text; // Mengambil nama kecamatan
    fetch(`/get-desa/${encodeURIComponent(kecamatanName)}`)
        .then(response => response.json())
        .then(data => {
            const desaSelect = document.getElementById('desa');
            desaSelect.innerHTML = '<option disabled selected>Pilih Desa</option>'; // Reset opsi desa
            data.forEach(desa => {
                const option = document.createElement('option');
                option.value = desa.nama; // Menggunakan nama desa sebagai value
                option.textContent = desa.nama;
                desaSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
});
    // Fungsi untuk menghitung umur
    function hitungUmur(tgl_lahir) {
        const birthDate = new Date(tgl_lahir);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDifference = today.getMonth() - birthDate.getMonth();
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }

    // Event listener untuk field tanggal lahir
    document.getElementById('tgl_lahir').addEventListener('change', function () {
        const umurInput = document.getElementById('umur');
        const umur = hitungUmur(this.value);
        umurInput.value = umur; // Set nilai umur ke input
    });
</script>
@endsection
