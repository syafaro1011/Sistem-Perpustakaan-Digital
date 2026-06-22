<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Peminjaman extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'peminjamans';

    protected $fillable = [
        'anggota_id', 'buku_id', 'user_id',
        'tanggal_pinjam', 'tanggal_kembali', 'status'
    ];

    protected $casts = [
        'tanggal_pinjam'  => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->useLogName('peminjaman');
    }

    public function anggota()   { return $this->belongsTo(Anggota::class); }
    public function buku()      { return $this->belongsTo(Buku::class); }
    public function user()      { return $this->belongsTo(User::class); }
    public function pengembalian() { return $this->hasOne(Pengembalian::class); }
}
