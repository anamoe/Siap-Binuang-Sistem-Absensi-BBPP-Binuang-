@extends('main')
@section('title', 'QR CODE')
@section('content')
<div class="container py-4">
    <h1 class="mb-3">Daftar Aset</h1>
    <a href="{{ url('dashboard-aset/create') }}" class="btn btn-primary mb-3">+ Tambah Aset</a>
    <a href="{{ url('labels') }}" class="btn btn-success mb-3" target="_blank">Cetak QR Code Aset</a>
    <div class="row g-3">
        @foreach ($asets as $a)
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $a->nama }}</h5>
                    <p class="mb-1"><strong>Lokasi:</strong> {{ $a->lokasi ?? '-' }}</p>
                    <p class="mb-1"><strong>Tim:</strong> {{ optional($a->team)->nama ?? '-' }}</p>
                    <p class="mb-3"><strong>Status:</strong> {{ ucfirst($a->status) }}</p>

                    <div class="d-flex gap-2 align-items-center">
                        {{-- QR kecil yang mengarah ke halaman show (auto popup) --}}
                        <div>
                            {!! QrCode::size(90)->margin(0)->generate(url('dashboardqr', $a->uuid)) !!}
                        </div>
                        <!-- <a class="btn btn-primary" href="{{ url('dashboardqr', $a->uuid) }}">
                            Detail
                        </a> -->
                        <a class="btn btn-sm btn-success" target="_blank" href="{{ url('dashboardqr', $a->uuid) }}">
                            Detail
                        </a>
                        <td>
                            <a href="{{ url('dashboard-aset', $a->uuid) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ url('dashboard-aset', $a->uuid) }}"
                                method="POST"
                                style="display:inline-block"
                                id="delete-form-{{ $a->uuid }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $a->uuid }}')">Hapus</button>
                            </form>

                        </td>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $asets->links() }}
    </div>
</div>
@endsection