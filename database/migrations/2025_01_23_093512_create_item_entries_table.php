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
        Schema::create('item_entries', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('vendor_id');
            $table->integer('total_price');
            $table->enum('payment', ['cash', 'transfer', 'check']);
            $table->integer('quantity');
            $table->date('entry_date');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('vendor_id')->references('id')->on('vendors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_entries');
    }
};
