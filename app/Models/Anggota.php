<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Anggota extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['no_anggota', 'nama', 'email', 'no_hp', 'alamat', 'status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->useLogName('anggota');
    }

    // Relasi One-to-Many ke Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // Relasi One-to-Many ke Denda
    public function dendas()
    {
        return $this->hasMany(Denda::class);
    }
}
