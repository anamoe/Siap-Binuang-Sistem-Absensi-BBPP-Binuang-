@extends('main')
@section('title', 'Edit Aset')
@section('content')
<div class="container">
    <h3>Edit Aset</h3>

    <form action="{{ url('dashboard-aset', $asset) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Aset</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $asset->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="spesifikasi" class="form-label">Spesifikasi</label>
            <textarea class="form-control" id="spesifikasi" name="spesifikasi">{{ $asset->spesifikasi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $asset->lokasi }}">
        </div>

        <div class="mb-3">
            <label for="timkerja_id" class="form-label">Tim Kerja</label>
            <select name="timkerja_id" id="timkerja_id" class="form-select">
                <option value="">-- Pilih Tim Kerja --</option>
                @foreach($timkerjas as $tim)
                    <option value="{{ $tim->id }}" {{ $asset->timker_id == $tim->id ? 'selected' : '' }}>
                        {{ $tim->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="baik" {{ $asset->status == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak" {{ $asset->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
                <option value="hilang" {{ $asset->status == 'hilang' ? 'selected' : '' }}>Hilang</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="catatan" name="catatan">{{ $asset->catatan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('dashboard-aset') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
