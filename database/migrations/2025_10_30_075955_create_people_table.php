<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('sex', ['L','P'])->nullable();
            $table->string('pob', 100)->nullable();
            $table->date('dob')->nullable();
            $table->timestamps();
            $table->string('personable_type')->nullable(); // polymorphic
            $table->unsignedBigInteger('personable_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
