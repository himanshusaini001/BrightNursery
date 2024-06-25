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
        Schema::table('carts', function (Blueprint $table) {
            $table->string('tampid')->after('id')->nullable();
            $table->string('session_id')->after('product_id')->nullable()->default('n');

            // Remove foreign key constraint on user_id
            $table->dropForeign(['user_id']);

            // Modify the user_id column (assuming it's an integer type)
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('tampid');
            $table->dropColumn('session_id');
        });
    }
};
