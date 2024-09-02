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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone_number')->nullable(); 
            $table->string('social_insurance_number')->nullable();
            $table->date('date_of_birth')->nullable();

            // Empleo
            $table->string('employment_title')->nullable();
            $table->string('employment_key_skill')->nullable();

            // Dirección
            $table->string('address_city')->nullable();
            $table->string('address_street_name')->nullable();
            $table->string('address_street_address')->nullable();
            $table->string('address_zip_code')->nullable();
            $table->string('address_state')->nullable();
            $table->string('address_country')->nullable();
            $table->decimal('address_lat', 10, 7)->nullable();
            $table->decimal('address_lng', 10, 7)->nullable();

            // Tarjeta de crédito
            $table->string('credit_card_number')->nullable(); 

            // Suscripción
            $table->string('subscription_plan')->nullable();
            $table->string('subscription_status')->nullable();
            $table->string('subscription_payment_method')->nullable();
            $table->string('subscription_term')->nullable();

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
