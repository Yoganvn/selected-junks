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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');             // Nama Sepatu (ex: Compass Gazelle)
        $table->string('slug')->unique();   // URL ramah SEO (ex: compass-gazelle)
        $table->string('brand');            // Brand (ex: Nike, Compass)
        $table->decimal('size', 4, 1);      // Ukuran (bisa 42.5)
        $table->bigInteger('price');        // Harga
        $table->string('condition');        // Kondisi (ex: BNIB, 9/10)
        $table->text('description');        // Deskripsi detail
        $table->boolean('is_fullset')->default(true); // Ada box?
        $table->enum('status', ['available', 'sold'])->default('available');
        $table->string('image')->nullable(); // Foto sepatu
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
