<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tire_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tire_request_id')->unique();
            $table->unsignedBigInteger('supplier_id');
            $table->string('order_status')->default('ordered'); // ordered, arrived, completed
            $table->date('order_date')->nullable();
            $table->date('ordered_at')->nullable();
            $table->date('arrived_at')->nullable();
            $table->timestamps();

            $table->foreign('tire_request_id')->references('id')->on('tire_requests')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tire_orders');
    }
};
