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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            $table->date('reservation_date');
            $table->string('reservation_time', 10);
            $table->string('number_of_people', 10);
            $table->decimal('total_amount', 10, 0);
            $table->string('payment_method', 100);
            $table->string('stripe_session_id')->nullable();
            $table->string('payment_status', 100)->default('pending');
            $table->string('status', 100)->default('予約済み');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
