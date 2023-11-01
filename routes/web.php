<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\KategoriController;
//use App\Models\Bom;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now bom!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/sidebar', function () {
    return view('sidebar');
});

// Manufaktur Bahan
Route::get('/manufaktur/bahan', [BahanController::class, 'index'])->name('manufaktur.bahan');
Route::get('/manufaktur/create-bahan', [BahanController::class, 'create'])->name('manufaktur.create');
Route::get('/manufaktur/bahan-detail/{id}', [BahanController::class, 'show'])->name('manufaktur.bahan-detail');
Route::get('/manufaktur/bahan/update/{id}', [BahanController::class, 'edit'])->name('manufaktur.bahan-update');
Route::put('/manufaktur/bahan/update/{id}', [BahanController::class, 'update'])->name('manufaktur.bahan-update');
Route::delete('/manufaktur/bahan-detail/{id}', [BahanController::class, 'destroy'])->name('manufaktur.bahan-detail.destroy');
Route::get('/manufaktur/cetak-bahan/{id}', [BahanController::class, 'cetak'])->name('manufaktur.bahan-cetak');

Route::post('stores', [BahanController::class, 'store'])->name('stores');

// Manufaktur Produk
Route::get('/manufaktur/produk', [ProdukController::class, 'index'])->name('manufaktur.produk');
Route::get('/manufaktur/create-produk', [ProdukController::class, 'create'])->name('create-produk');
Route::get('/manufaktur/produk-detail/{id}', [ProdukController::class, 'show'])->name('manufaktur.produk-detail');
Route::get('/manufaktur/produk-update/{id}', [ProdukController::class, 'edit'])->name('manufaktur.produk-update');
Route::put('/manufaktur/produk-update/{id}', [ProdukController::class, 'update'])->name('manufaktur.produk-update');
Route::delete('/manufaktur/produk-detail/{id}', [ProdukController::class, 'destroy'])->name('manufaktur.produk-detail.destroy');
Route::post('/store', [ProdukController::class, 'store'])->name('store');
Route::get('/manufaktur/cetak-produk/{id}', [ProdukController::class, 'cetak'])->name('manufaktur.produk-cetak');
//KATEGORI OJOK DIUBAH COKKKK
Route::get('/get-kategori-suggestions', [KategoriController::class, 'getKategoriSuggestions']);
Route::post('/kstore', [KategoriController::class, 'kstore']);

// Struktur Biaya / Detail BOM
// Narik Produk,Bahan,Kategori NANDA
Route::get('/get-produk', [BomController::class, 'getProduk'])->name('get-produk');
Route::get('/get-kategori', [BomController::class, 'getKategori'])->name('get-kategori');
Route::get('/get-bahan-data', [BomController::class, 'getBahan'])->name('get-bahan');
Route::get('/get-bom', [BomController::class, 'getBom'])->name('get-bom');

Route::get('/manufaktur/bom', [BomController::class, 'index'])->name('manufaktur.bom');
//Tampilan tok ganok data e
Route::get('/manufaktur/detail-bom', function () {
    return view('manufaktur.detail-bom');
})->name('detail-bom');
Route::post('/manufaktur/simpan-bom', [BomController::class, 'simpanBOM'])->name('manufaktur.simpan-bom');
//anyar nizar kamis 26
Route::get('/manufaktur/detail-bom/{id_bom}', [BomController::class, 'indexdetail'])->name('manufaktur.detail-bom');
// Manufaktur/Bom sesuai id_bom gawe nang detail-bom
Route::get('/manufaktur/detail-bom/{id_bom}', [BomController::class, 'detailbom'])->name('manufaktur.detail-bom');

//CRUD
Route::get('/manufaktur/create-bom', [BomController::class, 'create'])->name('create-bom');
Route::post('manufaktur/simpan-bom', [BomController::class, 'simpanBom'])->name('simpan-bom');
Route::get('/manufaktur/edit-bom/{id_bom}', [BomController::class, 'editBom'])->name('manufaktur.bom-update');
Route::get('/manufaktur/bom-update/{id_bom}', [BomController::class, 'editBom'])->name('manufaktur.bom-update');
Route::put('/manufaktur/bom-update/{id_bom}', [BomController::class, 'updateBom'])->name('manufaktur.bom-update');
// Route::post('/manufaktur/bom-update/{id_bom}', [BomController::class, 'updateBom'])->name('manufaktur.bom-update');

//Edit njopok data option value
Route::get('/get-bom/{id_bom}', [BomController::class, 'getBomById'])->name('get-bom');

Route::get('/manufaktur/edit-bom/{id_bom}', [BomController::class, 'editBom'])->name('manufaktur.edit-bom');
// Route::post('manufaktur/bom-update/{id_bom}', [BomController::class, 'updateBom'])->name('manufaktur.bom-update');

// delete data bom
Route::delete('/manufaktur/bom-detail/{id}', [BomController::class, 'destroy'])->name('manufaktur.bom-detail.destroy');
