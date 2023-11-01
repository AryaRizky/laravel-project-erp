@extends('sidebar')

@section('title', 'Manufaktur')
@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Bills of Materials')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card mx-auto my-5" style="max-width: 70rem;">
        <div class="card-header text-center fw-bold fs-2 text-black">Bills of Materials</div>
        <div class="card-body">
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Bill Of Material Struktur Biaya | {{ Carbon::now()->format('d/m/Y') }}</p>
                        <p class="m-0">{{ $bom->internal_referensi }}</p>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col">Internal Referensi</th>
                        <th scope="col">Bahan</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Biaya Produksi/Product Cost</th>
                        <th scope="col">Biaya BoM</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <tr>
                            <td>{{ $bom->nama_produk }}</td>
                            <td>{{ $bom->internal_referensi }}</td>
                            <td></td>
                            <td>{{ $bom->jumlah_produk }}</td>
                            <td>{{ $bom->total_biaya_produk }}</td>
                            <td>{{ $bom->total_biaya_bahan }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>{{ $bom->nama_bahan }}</td>
                            <td>{{ $bom->jumlah_bahan }}</td>
                            <td>{{ $bom->total_biaya_bahan }}</td>
                            <td>{{ $bom->total_biaya_bahan }}</td>
                        </tr>
                        <tr class="border-none">
                            <th colspan="3"></th>
                            <th scope="row">Biaya Satuan</th>
                            <td>{{ $bom->produk->biaya_produksi }}</td>
                            <td>{{ $bom->bahan->harga_bahan }}</td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex gap-2 justify-content-end">
                <button type="submit" class="btn btn-secondary btn-sm">Print</button>
                {{-- <button type="submit" class="btn btn-warning btn-sm">Edit</button> --}}
                @if (isset($bom))
                    <a href="{{ route('manufaktur.edit-bom', ['id_bom' => $bom->id_bom]) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                @endif
                <form action="{{ route('manufaktur.bom-detail.destroy', ['id' => $bom->id_bom]) }}" method="post">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
