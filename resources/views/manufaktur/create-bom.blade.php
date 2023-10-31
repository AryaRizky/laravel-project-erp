@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Tambah Data BoM')

@section('content')
    <div class="card">
        <div class="card-body pt-3">
            <form action="{{ route('simpan-bom') }}" method="post" id="bomForm">
                @csrf
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
                            <option value="">- Pilih Produk -</option>
                            @if (isset($produk))
                                @foreach ($produk as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="">
                        <label for="inputState" class="form-label">Kategori</label>
                        <select class="form-select form-control-sm" id="nama_kategori" name="nama_kategori" required>
                            <option value="">- Pilih Kategori -</option>
                            @if (isset($kategori))
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="">
                        <label for="productCategory" class="form-label">Jumlah</label>
                        <input type="text" class="form-control form-control-sm" id="jumlah_produk" name="jumlah_produk"
                            required>
                    </div>
                    <div class="">
                        <label for="internalReference" class="form-label">Referensi</label>
                        <input type="text" class="form-control form-control-sm" name="internal_referensi" required>
                    </div>

                    <!-- Elemen input awal yang sudah ada -->
                    <div class="dynamicInputs row g-2">
                        <div class="col-md-8">
                            <label for="inputState" class="form-label">Pilih Bahan</label>
                            <select class="form-select form-control-sm" id="nama_bahan" name="nama_bahan" required>
                                <option value="">- Pilih bahan -</option>
                                @if (isset($bahan))
                                    @foreach ($bahan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_bahan }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputCity" class="form-label">Jumlah</label>
                            <input type="text" class="form-control form-control-sm" id="jumlah_bahan" name="jumlah_bahan"
                                required>
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
    {{-- Save dan Redirek --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mengisi pilihan Produk
            function populateProducts() {
                // Lakukan permintaan ke server untuk mengambil data produk
                fetch('{{ route('get-produk') }}')
                    .then((response) => response.json())
                    .then((data) => {
                        const selectProduk = document.getElementById('nama_produk');
                        selectProduk.innerHTML = ''; // Menghapus opsi yang ada jika ada

                        // Tambahkan opsi "Pilih Produk" sebagai opsi default
                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = '- Pilih Produk -';
                        selectProduk.appendChild(defaultOption);

                        // Loop melalui data produk dan tambahkan opsi untuk setiap produk
                        data.forEach((produk) => {
                            const option = document.createElement('option');
                            option.value = produk.id_produk; // Gunakan ID produk
                            option.textContent = produk.nama_produk; // Nama produk
                            selectProduk.appendChild(option);
                        });
                    })
                    .catch((error) => {
                        console.error('Terjadi kesalahan saat mengambil data Produk:', error);
                    });
            }

            // Panggil fungsi untuk mengisi pilihan Produk saat halaman dimuat
            populateProducts();


            // Fungsi untuk mengisi pilihan Kategori
            function populateCategories() {
                // Lakukan permintaan ke server untuk mengambil data kategori
                fetch('{{ route('get-kategori') }}')
                    .then((response) => response.json())
                    .then((data) => {
                        const selectKategori = document.getElementById('nama_kategori');
                        selectKategori.innerHTML = ''; // Menghapus opsi yang ada jika ada

                        // Tambahkan opsi "Pilih Kategori" sebagai opsi default
                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = '- Pilih Kategori -';
                        selectKategori.appendChild(defaultOption);

                        // Loop melalui data kategori dan tambahkan opsi untuk setiap kategori
                        data.forEach((kategori) => {
                            const option = document.createElement('option');
                            option.value = kategori.id_kategori; // Gunakan ID kategori
                            option.textContent = kategori.nama_kategori; // Nama kategori
                            selectKategori.appendChild(option);
                        });
                    })
                    .catch((error) => {
                        console.error('Terjadi kesalahan saat mengambil data Kategori:', error);
                    });
            }

            // Panggil fungsi untuk mengisi pilihan Kategori saat halaman dimuat
            populateCategories();

            // Fungsi untuk mengisi pilihan Bahan
            function populateMaterials() {
                // Lakukan permintaan ke server untuk mengambil data bahan
                fetch('{{ route('get-bahan') }}')
                    .then((response) => response.json())
                    .then((data) => {
                        const selectBahan = document.getElementById('nama_bahan');
                        selectBahan.innerHTML = ''; // Menghapus opsi yang ada jika ada

                        // Tambahkan opsi "Pilih Bahan" sebagai opsi default
                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = '- Pilih Bahan -';
                        selectBahan.appendChild(defaultOption);

                        // Loop melalui data bahan dan tambahkan opsi untuk setiap bahan
                        data.forEach((bahan) => {
                            const option = document.createElement('option');
                            option.value = bahan.id_bahan; // Gunakan ID bahan
                            option.textContent = bahan.nama_bahan; // Nama bahan
                            selectBahan.appendChild(option);
                        });
                    })
                    .catch((error) => {
                        console.error('Terjadi kesalahan saat mengambil data Bahan:', error);
                    });
            }

            // Panggil fungsi untuk mengisi pilihan Bahan saat halaman dimuat
            populateMaterials();
            document.getElementById('strukturBiayaButton').addEventListener('click', async function() {
                var nama_produkSelect = document.getElementById('nama_produk');
                var nama_produk = nama_produkSelect.options[nama_produkSelect.selectedIndex].value;

                var nama_kategoriSelect = document.getElementById('nama_kategori');
                var nama_kategori = nama_kategoriSelect.options[nama_kategoriSelect.selectedIndex]
                    .value;

                var jumlah_produk = document.getElementById('jumlah_produk').value;
                var internal_referensi = document.querySelector('input[name="internal_referensi"]')
                    .value;

                var nama_bahanSelect = document.getElementById('nama_bahan');
                var nama_bahan = nama_bahanSelect.options[nama_bahanSelect.selectedIndex].value;

                var jumlah_bahan = document.getElementById('jumlah_bahan').value;

                if (nama_produk !== "undefined" && nama_kategori !== "undefined" && nama_bahan !==
                    "undefined") {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route('simpan-bom') }}', true);
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                // Data berhasil disimpan, tampilkan pesan sukses
                                document.getElementById('success-message').style.display = 'block';

                                // Parsing respons JSON yang dikembalikan dari server
                                var response = JSON.parse(xhr.responseText);

                                // Redirect ke halaman detail-bom berdasarkan id_bom yang dikembalikan dari server
                                if (response.id_bom) {
                                    window.location.href = '/manufaktur/detail-bom/' + response
                                        .id_bom;
                                } else {
                                    console.error('Id BOM tidak ditemukan dalam respons.');
                                }
                            } else if (xhr.status === 419) {
                                // Tampilkan pesan kesalahan validasi jika ada kesalahan validasi pada server.
                                console.error('Terjadi kesalahan validasi saat menyimpan data.');
                            } else {
                                // Handle kesalahan jika ada
                                console.error('Terjadi kesalahan saat menyimpan data.');
                            }
                        }
                    };

                    var data = {
                        nama_produk: nama_produk,
                        nama_kategori: nama_kategori,
                        jumlah_produk: jumlah_produk,
                        internal_referensi: internal_referensi,
                        nama_bahan: nama_bahan,
                        jumlah_bahan: jumlah_bahan
                        // Tambahkan data bahan sesuai dengan kebutuhan.
                    };
                    xhr.send(JSON.stringify(data));
                } else {
                    console.error('Data tidak valid, pastikan Anda memilih semua opsi.');
                }
            });
        });
    </script>
@endsection
