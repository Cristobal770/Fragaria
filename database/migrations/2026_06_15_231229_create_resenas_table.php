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
       Schema::create('resenas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('perfume_id')->constrained('perfumes')->onDelete('cascade');
        $table->integer('calificacion');
        $table->text('comentario');
        $table->integer('duracion');
        $table->enum('proyeccion', ['leve', 'moderado', 'intenso']);
        $table->timestamps();

        
        $table->unique(['user_id', 'perfume_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
