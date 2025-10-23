@extends('main')
@section('title', 'Import Data BMN')
@section('content')
<div class="container py-4">
   <h3 class="text-center fw-bold">Import Data Aset BMN dari EXCEL</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('bmn.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex align-items-center gap-2">
            <input type="file" name="file" required class="form-control">
            <button class="btn btn-success">IMPORT</button>
        </div>
    </form>


    <div class="table-responsive mt-3">
       <h3 class="text-center fw-bold">Daftar Data Aset BMN</h3>

        <table id="bmnTable" class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Jenis BMN</th>
                    <th>Kode Satker</th>
                    <th>Nama Satker</th>
                    <th>Kode Barang</th>
                    <th>NUP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bmn as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $a->jenis_bmn }}</td>
                    <td>{{ $a->kode_satker }}</td>
                    <td>{{ $a->nama_satker }}</td>
                    <td>{{ $a->kode_barang }}</td>
                    <td>{{ $a->nup }}</td>

                    <td class="text-center">
                        <a href="{{ url('bmn', $a->kode_barang) }}"
                            target="_blank"
                            class="btn btn-sm btn-success mb-1">
                            Detail
                        </a>
                        <!-- <a href="{{ url('bmn', $a->kode_barang) }}" 
                           class="btn btn-sm btn-warning mb-1">
                           Edit
                        </a>
                        <form action="{{ url('bmn', $a->uuid) }}"
                              method="POST"
                              id="delete-form-{{ $a->uuid }}"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger"
                                    onclick="confirmDelete('{{ $a->uuid }}')">
                                Hapus
                            </button>
                        </form> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
@endsection