<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        Schema::create('section_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            $table->text('supervisor_comments')->nullable();
            $table->string('officer_services_number')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('request_id')->references('id')->on('tire_requests')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('section_approvals');
    }
};