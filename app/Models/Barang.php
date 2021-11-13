<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "m_barang";
    protected $primaryKey = 'id_barang';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
      'id_barang',
      'kode',
      'nama',
      'deskripsi',
      'id_jenis_barang',
      'id_satuan',
      'harga_beli',
      'harga_jual',
      'stok',
      'foto',
      'status',
    ];
}
