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
        Schema::create('suratpengantars', function (Blueprint $table) {
            $table->id();
            $table->string('jen_surat');
            $table->string('perihal');
            $table->string('nohp');
            $table->string('email');
            $table->string('name');            
            $table->string('jen_kel');
            $table->string('tplahir');
            $table->date('tglahir');
            $table->string('agama');
            $table->string('stat');
            $table->string('pkerja');
            $table->string('alamat');
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
        Schema::dropIfExists('suratpengantars');
    }
};
