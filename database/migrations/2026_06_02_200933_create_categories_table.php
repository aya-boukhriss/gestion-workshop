<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('couleur')->default('#3B82F6');
            $table->timestamps();
        });

        Schema::table('workshops', function (Blueprint $table) {
            $table->foreignId('categorie_id')->nullable()->constrained('categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropForeign(['categorie_id']);
            $table->dropColumn('categorie_id');
        });
        Schema::dropIfExists('categories');
    }
};