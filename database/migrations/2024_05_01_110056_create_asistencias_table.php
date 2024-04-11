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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_registroClase');
            $table->unsignedBigInteger('id_resultadoAsistencia');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_registroClase')->references('id')->on('clases')->onDelete('cascade');
            $table->foreign('id_resultadoAsistencia')->references('id')->on('estados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
