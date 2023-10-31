<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bahan extends Model
{
    protected $primaryKey = 'id_bahan';
    protected $table = 'tb_bahan';
    protected $fillable =  ['nama_bahan', 'biaya_bahan', 'harga_bahan', 'internal_referensi', 'gambar_bahan'];
    public $timestamps = false;

    use HasFactory;

    public function bom()
    {
        return $this->hasMany(Bom::class, 'id_bahan', 'id_bahan');
    }
}
