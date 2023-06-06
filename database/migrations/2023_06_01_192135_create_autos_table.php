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
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_carro',60);
            $table->integer('año');
            $table->unsignedBigInteger('persona_id'); // Llave foránea
            $table->foreign('persona_id')
            ->references('id')
            ->on('personas')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // Relación con la tabla 'modelos'
            $table->unsignedBigInteger('modelo_id'); // Llave foránea
            $table->foreign('modelo_id')
            ->references('id')
            ->on('modelos')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // Relación con la tabla 'modelos'
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autos');
    }
};
