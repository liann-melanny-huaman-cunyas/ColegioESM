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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table  ->foreignId('student_id')
                    ->cascadeOnUpdate()
                    ->nullOnDelete()
                    ->constrained();
            $table  ->foreignId('election_id')
                    ->cascadeOnUpdate()
                    ->nullOnDelete()
                    ->constrained();
            $table  ->foreignId('candidate_id')
                    ->nullable() // Make this nullable
                    ->cascadeOnUpdate()
                    ->nullOnDelete()
                    ->constrained();
            $table-> boolean('is_blank_vote')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
