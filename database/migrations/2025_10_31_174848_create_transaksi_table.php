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
        Schema::create('transaksi_obat', function (Blueprint $table) {
            $table->id(); // ID transaksi
            $table->string('kode_transaksi')->unique(); // kode transaksi unik
            $table->unsignedBigInteger('obat_id'); // ID obat
            $table->unsignedBigInteger('kategori_id'); // ID kategori obat
            $table->unsignedBigInteger('supplier_id'); // ID supplier
            $table->integer('jumlah'); // jumlah obat diterima
            $table->decimal('harga_satuan', 15, 2); // harga per obat
            $table->decimal('total_harga', 15, 2); // total harga
            $table->date('tanggal_transaksi'); // tanggal penerimaan
            $table->timestamps();

            // 🔹 Relasi foreign key
            $table->foreign('obat_id')->references('id')->on('obat')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_obat');
    }
};
