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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cid');
            $table->string('name');
            $table->text('img');
            $table->integer('stock');
            $table->float('price');
            $table->string('description');
            $table->tinyInteger('status');
            $table->json('meta')->nullable();
            $table->timestamps();
        
            $table->foreign('cid')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
