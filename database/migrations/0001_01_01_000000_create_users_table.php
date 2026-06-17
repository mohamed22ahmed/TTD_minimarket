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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('img')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('payment_testing')->default(true);
            $table->integer('payment_count')->default(0);
            $table->string('otp')->nullable();
            $table->boolean('verified')->default(0);
            $table->string('gender')->default('male');
            $table->string('user_type')->default('customer');
            $table->string('fcm_token')->nullable();
            $table->text('jwt_token')->nullable();
            $table->string('default_lang')->default('en');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
