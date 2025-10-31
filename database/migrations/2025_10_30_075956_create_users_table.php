<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->string('username', 50)->unique();
            $table->string('email', 100)->nullable()->unique();
            $table->string('password');
            $table->string('reference_type')->nullable(); // polymorphic reference
            $table->unsignedBigInteger('reference_id')->nullable(); // polymorphic reference
            $table->rememberToken();
            $table->timestamps(); // created_at, updated_at

            $table->index(['person_id', 'reference_type', 'reference_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
