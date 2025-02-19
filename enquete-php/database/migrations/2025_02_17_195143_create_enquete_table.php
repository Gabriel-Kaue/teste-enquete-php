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
        Schema::create('enquete', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('dtInicio');
            $table->dateTime('dtFim');
            $table->string('titulo');
            $table->enum('status', ['não iniciada','em andamento','finalizada']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquete');
    }
};
