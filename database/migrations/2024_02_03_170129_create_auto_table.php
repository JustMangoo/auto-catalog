<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auto', function (Blueprint $table) {
            $table->bigIncrements('auto_id');
            $table->string('autonr', 20);
            $table->year('autogads');
            $table->unsignedBigInteger('marka_id');
            $table->unsignedBigInteger('motors_id');
            $table->decimal('motoratilpums', 4, 0);
            $table->decimal('pilnamasa', 4, 0);
            $table->decimal('pasmasa', 4, 0);
            $table->unsignedBigInteger('piedzina_id');
            // Add other columns as needed

            $table->foreign('marka_id')->references('marka_id')->on('marka')->onDelete('cascade');
            $table->foreign('motors_id')->references('motors_id')->on('motors')->onDelete('cascade');
            $table->foreign('piedzina_id')->references('piedzina_id')->on('piedzina')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto');
    }
};
