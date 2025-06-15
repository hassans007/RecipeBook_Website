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
        // Add recipe_id column to macros table
        Schema::table('recipes', function (Blueprint $table) {
            $table->unsignedBigInteger('macro_id');
            $table->foreign('macro_id')->references('id')->on('macros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign(['macro_id']);
            $table->dropColumn('macro_id');
        });
    }
};
