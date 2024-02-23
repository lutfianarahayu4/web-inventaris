<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Barang;



class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';

    protected $fillable = [
        'id_siswa',
        'id_barang',
        'gambar',
        'tanggal_pinjam',
        'tanggal_kembali',
        'kondisi',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
     public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
