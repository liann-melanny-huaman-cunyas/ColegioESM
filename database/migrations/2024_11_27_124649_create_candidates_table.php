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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table  ->foreignId('student_id')
                    ->cascadeOnUpdate()
                    ->nullOnDelete()
                    ->constrained();
            $table->longText('simbolo')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->date('fecha_inscripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
