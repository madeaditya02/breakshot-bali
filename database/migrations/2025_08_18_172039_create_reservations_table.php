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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('group')->nullable();
            $table->datetime('start');
            $table->datetime('end');
            $table->string('agenda');
            $table->integer('count');
            $table->string('phone');
            $table->text('notes')->nullable();
            $table->enum('status', ['Diterima', 'Ditolak'])->nullable();
            $table->enum('type', ['Bawa Player', 'Karaoke']);
            $table->enum('menu_type', ['A la carte', 'Prasmanan']);
            $table->foreignId('sheet_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
