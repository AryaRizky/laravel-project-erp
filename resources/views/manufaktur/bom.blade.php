@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Data BoM')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card card-body pt-3" id="bomDataContainer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID BoM</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($bom))
                    @foreach ($bom as $bom)
                        <tr>
                            <th scope="row">{{ $bom->id_bom }}</th>
                            <td>{{ $bom->nama_produk }}</td>
                            <td>{{ $bom->nama_kategori }}</td>
                            <td>{{ $bom->jumlah_produk }}</td>
                            <td class="text-center">
                                {{-- <a href="">Detail</a> | --}}
                                <a href="{{ route('manufaktur.detail-bom', ['id_bom' => $bom->id_bom]) }}">Detail</a>
                                <a href="{{ route('manufaktur.bom-update', ['id_bom' => $bom->id_bom]) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">Data BoM tidak tersedia.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    </div>
@endsection
