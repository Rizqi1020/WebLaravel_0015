<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('posts', function (Blueprint $table) {
        $table->string('publisher')->default('Redaksi');
        $table->string('image')->nullable()->comment('Menyimpan link gambar internet');
        $table->string('category')->default('Umum');
    });
}

public function down(): void
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn(['publisher', 'image', 'category']);
    });
}
};
