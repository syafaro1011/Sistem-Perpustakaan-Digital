<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Buku extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'kode_buku', 'judul', 'penulis', 'penerbit',
        'tahun_terbit', 'stok', 'isbn', 'sinopsis', 'cover'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->useLogName('buku');
    }

    // Relasi Many-to-Many ke Kategori
    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'buku_kategori');
    }

    // Relasi One-to-Many ke Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
