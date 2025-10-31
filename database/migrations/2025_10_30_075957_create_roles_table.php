<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->timestamps(); // created_at, updated_at
            $table->string('guard_name', 50)->default('web'); // optional untuk auth guard
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
