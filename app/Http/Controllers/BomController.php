<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Bahan;
use App\Models\Bom;

class BomController extends Controller
{
    public function index()
    {
        $bom = Bom::all();
        return view('manufaktur.bom', compact('bom'));
    }

    public function create()
    {
        $produk = Produk::all();
        $bahan = Bahan::all();
        $kategori = Kategori::all();
        return view('manufaktur.create-bom', compact('produk', 'bahan', 'kategori'));
    }

    public function simpanBOM(Request $request)
    {
        // Validasi data yang dikirim dari formulir
        $validatedData = $request->validate([
            'nama_produk' => 'required|integer',
            'nama_kategori' => 'required|integer',
            'jumlah_produk' => 'required|numeric',
            'internal_referensi' => 'required|string',
            'nama_bahan' => 'required|integer',
            'jumlah_bahan' => 'required|numeric',
        ]);

        // Mengambil data nama_produk, nama_kategori, dan nama_bahan dari model terkait
        $produk = Produk::find($validatedData['nama_produk']);
        $kategori = Kategori::find($validatedData['nama_kategori']);
        $bahan = Bahan::find($validatedData['nama_bahan']);
        
        if ($produk && $bahan) {
            $biayaProduksi = $produk->biaya_produksi * $validatedData['jumlah_produk'];
            $biayaBahan = $bahan->biaya_bahan * $validatedData['jumlah_bahan'];
        } else {
            $biayaProduksi = 0;
            $biayaBahan = 0;
        }

        // Simpan data ke database
        $bom = new Bom();
        $bom->id_produk = $validatedData['nama_produk'];
        $bom->id_kategori = $validatedData['nama_kategori'];
        $bom->jumlah_produk = $validatedData['jumlah_produk'];
        $bom->internal_referensi = $validatedData['internal_referensi'];
        $bom->id_bahan = $validatedData['nama_bahan'];
        $bom->jumlah_bahan = $validatedData['jumlah_bahan'];
        $bom->total_biaya_produk = $biayaProduksi;
        $bom->total_biaya_bahan = $biayaBahan;

        // Set nama_produk, nama_kategori, dan nama_bahan dalam model bom
        $bom->nama_produk = $produk->nama_produk;
        $bom->nama_kategori = $kategori->nama_kategori;
        $bom->nama_bahan = $bahan->nama_bahan;
        
        $bom->save();

        return redirect()
            ->route('manufaktur.detail-bom', ['id_bom' => $bom->id_bom])
            ->with('success', 'Data berhasil disimpan!');
    }

    public function detailbom($id_bom)
    {
        // Query bom berdasarkan primary key 'id_bom'
        $bom = Bom::find($id_bom);

        return view('manufaktur.detail-bom', compact('bom'));
    }

    public function editBom($id_bom)
    {
        // Temukan BOM berdasarkan ID
        $bom = Bom::find($id_bom);
        // Temukan daftar produk, kategori, dan bahan yang dapat digunakan untuk opsi edit
        $produkList = Produk::all();
        $kategoriList = Kategori::all();
        $bahanList = Bahan::all();

        return view('manufaktur.bom-update', compact('bom', 'produkList', 'kategoriList', 'bahanList'));
        // return view('manufaktur.bom-update', compact('bom', 'produk', 'kategori', 'bahan'));

    }
    public function updateBom(Request $request, $id_bom)
    {
        // Validasi data yang dikirim dari formulir edit
        $request->validate([
            'nama_produk' => 'required|integer',
            'nama_kategori' => 'required|integer',
            'jumlah_produk' => 'required|numeric',
            'internal_referensi' => 'required|string',
            'nama_bahan' => 'required|integer',
            'jumlah_bahan' => 'required|numeric',
        ]);

        // Temukan BOM berdasarkan ID
        $bom = Bom::find($id_bom);

        if (!$bom) {
            return back()->with('error', 'BOM tidak ditemukan.');
        }

        // Mengambil data nama_produk, nama_kategori, dan nama_bahan dari model terkait
        $produk = Produk::find($request['nama_produk']);
        $kategori = Kategori::find($request['nama_kategori']);
        $bahan = Bahan::find($request['nama_bahan']);

        // Perhitungan
        $biayaProduksi = $produk->biaya_produksi;
        $biayaBahan = $bahan->biaya_bahan;
        $totalBiayaProduksi = $biayaProduksi * $request['jumlah_produk'];
        $totalBiayaBahan = $biayaBahan * $request['jumlah_bahan'];

        // Perbarui data BOM dengan data yang baru
        $bom->id_produk = $request['nama_produk'];
        $bom->id_kategori = $request['nama_kategori'];
        $bom->jumlah_produk = $request['jumlah_produk'];
        $bom->internal_referensi = $request['internal_referensi'];
        $bom->id_bahan = $request['nama_bahan'];
        $bom->jumlah_bahan = $request['jumlah_bahan'];
        $bom->total_biaya_produk = $totalBiayaProduksi;
        $bom->total_biaya_bahan = $totalBiayaBahan;

        // Set nama_produk, nama_kategori, dan nama_bahan dalam model bom
        $bom->nama_produk = $produk->nama_produk;
        $bom->nama_kategori = $kategori->nama_kategori;
        $bom->nama_bahan = $bahan->nama_bahan;

        // Lakukan perhitungan total_biaya dan total_bom sesuai dengan logika aplikasi Anda

        // Simpan perubahan data BOM
        $bom->save();
        return redirect()
            ->route('manufaktur.detail-bom', ['id_bom' => $bom->id_bom])
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $bom = Bom::find($id);

        if (!$bom) {
            return redirect()->route('manufaktur.bom')->with('error', 'Data Bom tidak ditemukan.');
        }

        $bom->delete();
        return redirect()->route('manufaktur.bom')->with('success', 'Data Bom berhasil dihapus.');
    }

    public function getBomById($id_bom)
    {
        $bom = Bom::find($id_bom);
    
        if (!$bom) {
            return response()->json(['error' => 'BOM not found'], 404);
        }
    
        $produk = Produk::all(); // Ganti dengan model Produk yang sesuai
        $kategori = Kategori::all(); // Ganti dengan model Kategori yang sesuai
        $bahan = Bahan::all(); // Ganti dengan model Bahan yang sesuai
    
        $data = [
            'produk' => $produk,
            'kategori' => $kategori,
            'bahan' => $bahan,
        ];
    
        return response()->json($data);
    }
    
    public function getProduk()
    {
        $produk = Produk::all(); // Ganti dengan model Produk yang sesuai
        return response()->json($produk);
    }
    
    public function getKategori()
    {
        $kategori = Kategori::all(); // Ganti dengan model Kategori yang sesuai
        return response()->json($kategori);
    }
    
    public function getBahan()
    {
        $bahan = Bahan::all(); // Ganti dengan model Bahan yang sesuai
        return response()->json($bahan);
    }
    
}
