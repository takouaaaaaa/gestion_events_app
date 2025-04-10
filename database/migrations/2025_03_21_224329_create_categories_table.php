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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['Poucet ', 'Poussin', 'Benjamin', 'Minime', 'Cadet', 'Junior', 'Senior']);
            $table->enum('gender', ['M', 'F']);
            $table->string('weight', 60);
            $table->string('slug');
            $table->timestamps();

            $table->foreignId('event_sportif_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
