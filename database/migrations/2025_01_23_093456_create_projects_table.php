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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('project_value');
            $table->string('location');
            $table->enum('status', ['ongoing', 'finished']);
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('ipa_baja_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('ipa_baja_id')->references('id')->on('ipa_bajas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
