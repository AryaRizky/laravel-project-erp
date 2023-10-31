@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Update Bill Of Material')

@section('content')
    <div class="card">
        <div class="card-body pt-3">
            <form method="post" action="{{ route('manufaktur.bom-update', ['id_bom' => $bom->id_bom]) }}">
                <input type="hidden" name="id_bom" value="{{ $bom->id_bom }}">
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-end">
                    {{-- REDIREK TOK --}}
                    {{-- <a href="{{ route('detail-bom') }}" class="btn btn-primary btn-sm">Struktur Biaya</a> --}}
                    {{-- Save karo Redirek --}}
                    <button type="submit" class="btn btn-primary btn-sm" id="strukturBiayaButton">Struktur Biaya</button>

                </div>

                <div class="row g-3">
                    <div class="">
                        <label for="inputState" class="form-label">Produk</label>
                        <select class="form-select form-control-sm" id="nama_produk" name="nama_produk" required>
                            <option value="" hidden>- Pilih Produk -</option>
                            @foreach ($produkList as $item)
                                <option value="{{ $item->id_produk }}" selected>
                                    {{ $item->nama_produk }}
                                </option>
                            @endforeach
                            {{-- @if (isset($produk)) --}}
                            {{-- @foreach ($produk as $item)
                                    <option value="{{ $item->id }}" @if (isset($bom) && $bom->id_produk == $item->id) selected @endif>
                                        {{ $item->nama_produk }}</option>
                                @endforeach --}}
                            {{-- @foreach ($bom->$produk as $pr)
                                    <option value="{{ $pr->id }}">{{ $pr->nama_produk }}</option>
                                @endforeach --}}
                            {{-- @endif --}}
                        </select>
                    </div>

                    <div class="">
                        <label for="inputState" class="form-label">Kategori</label>
                        <select class="form-select form-control-sm" id="nama_kategori" name="nama_kategori" required>
                            <option value="" hidden>- Pilih Kategori -</option>
                            @foreach ($kategoriList as $item)
                                <option value="{{ $item->id_kategori }}" selected>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="productCategory" class="form-label">Jumlah</label>
                        <input type="text" class="form-control form-control-sm" id="jumlah_produk" name="jumlah_produk"
                            required @if (isset($bom)) value="{{ $bom->jumlah_produk }}" @endif>
                    </div>
                    <div class="">
                        <label for="internalReference" class a form-label="">Referensi</label>
                        <input type="text" class="form-control form-control-sm" name="internal_referensi" required
                            @if (isset($bom)) value="{{ $bom->internal_referensi }}" @endif>
                    </div>

                    <!-- Elemen input awal yang sudah ada -->
                    <div class="dynamicInputs row g-2">
                        <div class="col-md-8">
                            <label for="inputState" class="form-label">Pilih Bahan</label>
                            <select class="form-select form-control-sm" id="nama_bahan" name="nama_bahan" required>
                                <option value="">- Pilih Bahan -</option>
                                
                                    @foreach ($bahanList as $item)
                                        <option value="{{ $item->id_bahan }}"
                                            selected>{{ $item->nama_bahan }}
                                        </option>
                                    @endforeach
                                
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputCity" class="form-label">Jumlah</label>
                            <input type="text" class="form-control form-control-sm" id="jumlah_bahan" name="jumlah_bahan"
                                required @if (isset($bom)) value="{{ $bom->jumlah_bahan }}" @endif>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        {{-- <button type="button" class="btn btn-primary btn-sm" id="addInputBtn">+</button> --}}
                        {{-- <button type="button" class="btn btn-primary btn-sm" id="addInputBtn">-</button> --}}
                    </div>
                </div>

                <div id="success-message" style="display: none" class="alert alert-success">
                    Data berhasil disimpan!
                </div>
            </form>
        </div>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil data BOM dari server berdasarkan ID_BOM
            fetch('{{ route('get-bom', ['id_bom' => $bom->id_bom]) }}')
                .then(response => response.json())
                .then(data => {
                    // Isi data produk
                    const produkSelect = document.getElementById('nama_produk');
                    produkSelect.innerHTML = ''; // Bersihkan opsi sebelumnya
                    data.produk.forEach(produk => {
                        const option = document.createElement('option');
                        option.value = produk.id;
                        option.textContent = produk.nama_produk;
                        produkSelect.appendChild(option);
                    });

                    // Isi data kategori
                    const kategoriSelect = document.getElementById('nama_kategori');
                    kategoriSelect.innerHTML = '';
                    data.kategori.forEach(kategori => {
                        const option = document.createElement('option');
                        option.value = kategori.id;
                        option.textContent = kategori.nama_kategori;
                        kategoriSelect.appendChild(option);
                    });

                    // Isi data bahan
                    const bahanSelect = document.getElementById('nama_bahan');
                    bahanSelect.innerHTML = '';
                    data.bahan.forEach(bahan => {
                        const option = document.createElement('option');
                        option.value = bahan.id;
                        option.textContent = bahan.nama_bahan;
                        bahanSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat mengambil data BOM:', error);
                });
        });
    </script>
    <script>
        document.getElementById('strukturBiayaButton').addEventListener('click', async function() {
            const nama_produkSelect = document.getElementById('nama_produk');
            const nama_produk = nama_produkSelect.options[nama_produkSelect.selectedIndex].value;

            const nama_kategoriSelect = document.getElementById('nama_kategori');
            const nama_kategori = nama_kategoriSelect.options[nama_kategoriSelect.selectedIndex].value;

            const jumlah_produk = document.getElementById('jumlah_produk').value;
            const internal_referensi = document.querySelector('input[name="internal_referensi"]').value;

            const nama_bahanSelect = document.getElementById('nama_bahan');
            const nama_bahan = nama_bahanSelect.options[nama_bahanSelect.selectedIndex].value;

            const jumlah_bahan = document.getElementById('jumlah_bahan').value;

            if (typeof nama_produk !== "undefined" && typeof nama_kategori !== "undefined" &&
                typeof nama_bahan !== "undefined") {
                const data = {
                    nama_produk: nama_produk,
                    nama_kategori: nama_kategori,
                    jumlah_produk: jumlah_produk,
                    internal_referensi: internal_referensi,
                    nama_bahan: nama_bahan,
                    jumlah_bahan: jumlah_bahan
                    // Tambahkan data bahan sesuai dengan kebutuhan.
                };

                // Kirim data pembaruan BOM ke server
                fetch(`{{ route('manufaktur.bom-update', ['id_bom' => $bom->id_bom]) }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(responseData => {
                        // Handle respons dari server
                        if (responseData.success) {
                            // Data berhasil diperbarui, lakukan tindakan yang sesuai
                            document.getElementById('success-message').style.display = 'block';
                            window.location.href = responseData.redirectTo;
                        } else {
                            console.error('Terjadi kesalahan saat menyimpan data:', responseData.error);
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan saat menyimpan data:', error);
                    });
            } else {
                console.error('Data tidak valid, pastikan Anda memilih semua opsi.');
            }
        });
    </script> --}}
@endsection
