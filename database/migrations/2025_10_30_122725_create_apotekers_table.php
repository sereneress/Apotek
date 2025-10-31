<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apotekers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('license_number')->nullable();
            $table->date('start_date')->nullable();
            $table->enum('employment_status', ['tetap','kontrak','magang'])->default('tetap');
            $table->string('last_education')->nullable();
            $table->enum('status', ['aktif','non-aktif'])->default('aktif');
            $table->string('profile_image')->nullable();
            $table->string('shift')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apotekers');
    }
};
