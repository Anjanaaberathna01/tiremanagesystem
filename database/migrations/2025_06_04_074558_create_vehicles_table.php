<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number');
            $table->string('model');
            $table->string('brand');      
            $table->year('register_year')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('branch');
            $table->string('department')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('vehicles');
    }
};
