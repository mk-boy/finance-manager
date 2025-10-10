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
        Schema::create('payment_changes_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->integer('old_value');
            $table->timestamps();
        });

        Schema::table('payment_changes_histories', function (Blueprint $table) {
            $table->index('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_changes_histories');

        Schema::table('payment_changes_histories', function (Blueprint $table) {
            $table->dropIndex(['payment_id']);
        });
    }
};
