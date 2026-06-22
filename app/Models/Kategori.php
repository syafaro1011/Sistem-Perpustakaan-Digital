<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Kategori extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->useLogName('kategori');
    }

    // Relasi Many-to-Many ke Buku
    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'buku_kategori');
    }
}
