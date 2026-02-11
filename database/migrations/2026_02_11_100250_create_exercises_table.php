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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            // si borro una categoria se borran sus ejercicios.
            $table->foreignId('category_id')
                  ->constrained() // este me crea automáticamente la foreign key apuntando
                  // a la tabla categories.
                  ->onDelete('cascade');
                  $table->string('name');
                  // uso text, ya que puede ser más largo.
                  $table->text('instruction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
