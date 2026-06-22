<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('dendas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pengembalian_id')->constrained('pengembalians')->onDelete('cascade');
        $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
        $table->integer('hari_terlambat')->default(0);
        $table->decimal('jumlah_denda', 10, 2)->default(0);
        $table->enum('status_bayar', ['belum_bayar', 'sudah_bayar'])->default('belum_bayar');
        $table->date('tanggal_bayar')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dendas');
    }
};
