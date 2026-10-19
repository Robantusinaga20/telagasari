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
        Schema::create('suratpengadus', function (Blueprint $table) {
            $table->id();
            $table->string('perihal');
            $table->string('nohp');
            $table->longText('gambar');
            $table->string('name');            
            $table->string('alamat');
            $table->text('lokasi');
            $table->text('deskripsi');
            $table->string('status')->default('Diproses'); // Pending / Processed
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratpengadus');
    }
};
