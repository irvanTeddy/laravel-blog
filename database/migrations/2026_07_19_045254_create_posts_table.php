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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');       // Judul artikel
            $table->string('slug')->unique(); // URL ramah SEO (misal: /blog/belajar-laravel)
            $table->text('content');      // Isi artikel panjang
            $table->string('image')->nullable(); // Nama file gambar (boleh kosong)
            $table->timestamps();         // Otomatis bikin kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
