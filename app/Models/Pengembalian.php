<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Pengembalian extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'peminjaman_id', 'tanggal_kembali_aktual',
        'hari_terlambat', 'kondisi_buku', 'catatan'
    ];

    protected $casts = [
        'tanggal_kembali_aktual' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->useLogName('pengembalian');
    }

    public function peminjaman() { return $this->belongsTo(Peminjaman::class); }
    public function denda()      { return $this->hasOne(Denda::class); }
}
