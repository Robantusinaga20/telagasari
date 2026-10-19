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
        Schema::table('prktdesas', function (Blueprint $table) {
        $table->string('jabatan')->change(); // ubah ke string
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prktdesas', function (Blueprint $table) {
            $table->date('jabatan')->change();
    });
}
};
