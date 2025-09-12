<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mechanical_approval_checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('user_id');
            $table->string('warranty_state');
            $table->string('incorrect_alignment');
            $table->string('detective_steering_system');
            $table->string('detective_suspension');
            $table->string('purchase_tires');
            $table->text('mechanic_comments')->nullable();
            $table->string('mechanic_officer_services_number')->nullable();
            $table->string('approval_status');
            $table->timestamp('updated_at')->nullable();

            $table->foreign('request_id')->references('id')->on('tire_requests')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('mechanical_approval_checks');
    }
};

