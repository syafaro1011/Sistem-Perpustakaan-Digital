<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Denda extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'pengembalian_id', 'anggota_id',
        'hari_terlambat', 'jumlah_denda',
        'status_bayar', 'tanggal_bayar'
    ];

    protected $casts = [
        'tanggal_bayar'  => 'date',
        'jumlah_denda'   => 'decimal:2',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->useLogName('denda');
    }

    public function pengembalian() { return $this->belongsTo(Pengembalian::class); }
    public function anggota()      { return $this->belongsTo(Anggota::class); }
}
