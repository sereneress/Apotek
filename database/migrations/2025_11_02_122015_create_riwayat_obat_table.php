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
        Schema::create('riwayat_obat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obat_id')->constrained('obats')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('tipe', ['masuk', 'keluar']); // jenis pergerakan
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 15, 2)->nullable(); // opsional
            $table->decimal('total', 15, 2)->nullable(); // opsional
            $table->string('sumber')->nullable(); // contoh: 'Transaksi Penjualan #1'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_obat');
    }
};
