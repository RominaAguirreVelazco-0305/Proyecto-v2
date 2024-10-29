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
        Schema::table('investments', function (Blueprint $table) {
            $table->decimal('goal_amount', 10, 2); // Agrega la cantidad objetivo
            $table->integer('investor_count')->default(0); // Agrega el contador de inversores
            $table->decimal('raised_amount', 10, 2)->default(0.00); // Agrega la cantidad recaudada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn('goal_amount'); // Elimina la columna goal_amount
            $table->dropColumn('investor_count'); // Elimina la columna investor_count
            $table->dropColumn('raised_amount'); // Elimina la columna raised_amount
        });
    }
};
