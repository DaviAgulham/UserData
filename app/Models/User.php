<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Definir los campos que pueden ser asignados en masa (mass assignment)
    protected $fillable = [
        'uid',
        'password',
        'first_name',
        'last_name',
        'username',
        'email',
        'avatar',
        'gender',
        'phone_number',
        'social_insurance_number',
        'date_of_birth',
        'employment_title',
        'employment_key_skill',
        'address_city',
        'address_street_name',
        'address_street_address',
        'address_zip_code',
        'address_state',
        'address_country',
        'address_lat',
        'address_lng',
        'credit_card_number',
        'subscription_plan',
        'subscription_status',
        'subscription_payment_method',
        'subscription_term',
    ];

    // Especificar los tipos de los campos que deberían ser tratados como fechas
    protected $casts = [
        'date_of_birth' => 'date',
        'address_lat' => 'float',
        'address_lng' => 'float',
    ];
}
