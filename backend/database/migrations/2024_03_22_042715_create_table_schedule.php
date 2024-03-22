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
        if (!Schema::hasTable('table_schedule')) {
            Schema::create('table_schedule', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->string('email', 100);
                $table->date('date_of_birth');
                $table->string('cpf', 11);
                $table->string('phone', 11);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_schedule');
    }
};
