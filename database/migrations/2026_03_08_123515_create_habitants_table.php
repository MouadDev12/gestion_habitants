<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_create_habitants_table.php
public function up(): void
{
    Schema::create('habitants', function (Blueprint $table) {
        $table->id();
        $table->string('cin', 20)->unique();
        $table->string('nom', 100);
        $table->string('prenom', 100);
        $table->string('photo')->nullable();
        $table->foreignId('ville_id')
              ->constrained('villes')
              ->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitants');
    }
};
