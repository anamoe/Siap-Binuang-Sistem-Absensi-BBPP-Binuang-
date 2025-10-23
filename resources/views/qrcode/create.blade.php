@extends('main')
@section('title', 'Tambah ASET')
@section('content')
<div class="container">
    <h3>Tambah Aset Baru</h3>

    <form action="{{ url('dashboard-aset') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Aset</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="spesifikasi" class="form-label">Spesifikasi</label>
            <textarea class="form-control" id="spesifikasi" name="spesifikasi"></textarea>
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi">
        </div>

        <div class="mb-3">
            <label for="timkerja_id" class="form-label">Tim Kerja</label>
            <select name="timkerja_id" id="timkerja_id" class="form-select">
                <option value="">-- Pilih Tim Kerja --</option>
                @foreach($timkerjas as $tim)
                    <option value="{{ $tim->id }}">{{ $tim->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
                <option value="hilang">Hilang</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="catatan" name="catatan"></textarea>
        </div>

        <button type="submit" class="btn btn-success" >Simpan</button>
        <a href="{{ url('dashboard-aset') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
