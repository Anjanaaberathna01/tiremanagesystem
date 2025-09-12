<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        Schema::create('tires', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->string('brand');
            $table->decimal('price', 10, 2);
            $table->integer('warranty_distance');
            $table->integer('reference_no');
            $table->date('date');
            $table->timestamps();

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tires');
    }
};
