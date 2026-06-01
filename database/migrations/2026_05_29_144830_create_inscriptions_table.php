<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_participant')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_workshop')->constrained('workshops')->onDelete('cascade');
            $table->dateTime('date_inscription')->useCurrent();
            $table->enum('statut', ['confirmee', 'liste_attente', 'annulee'])->default('confirmee');
            $table->boolean('liste_attente')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};