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
        Schema::create('auction_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auction_id')->constrained('auctions');
            $table->foreignId('card_id')->constrained('cards');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->integer('highest_bid')->default(0);
            $table->boolean('sold')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_cards');
    }
};
