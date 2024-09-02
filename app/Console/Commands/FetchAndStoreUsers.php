<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class FetchAndStoreUsers extends Command
{
    protected $signature = 'fetch:users';
    protected $description = 'Fetch users from API and store them in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // URL del endpoint
        $url = 'https://random-data-api.com/api/v2/users?size=100&is_xml=true';
        
        // Hacer la solicitud HTTP
        $response = Http::get($url);

        if ($response->successful()) {
            $users = $response->json();
            $inserted = 0;
            $updated = 0;
            
            foreach ($users as $userData) {
                // Busca al usuario por UID o por email
                $user = User::where('uid', $userData['uid'])
                            ->orWhere('email', $userData['email'])
                            ->first();

                if ($user) {
                    // Si el usuario existe, actualiza sus datos
                    $user->update([
                        'password' => bcrypt($userData['password']),
                        'first_name' => $userData['first_name'],
                        'last_name' => $userData['last_name'],
                        'username' => $userData['username'],
                        'email' => $userData['email'],
                        'avatar' => $userData['avatar'],
                        'gender' => $userData['gender'],
                        'phone_number' => $userData['phone_number'],
                        'social_insurance_number' => $userData['social_insurance_number'],
                        'date_of_birth' => $userData['date_of_birth'],
                        'employment_title' => $userData['employment']['title'],
                        'employment_key_skill' => $userData['employment']['key_skill'],
                        'address_city' => $userData['address']['city'],
                        'address_street_name' => $userData['address']['street_name'],
                        'address_street_address' => $userData['address']['street_address'],
                        'address_zip_code' => $userData['address']['zip_code'],
                        'address_state' => $userData['address']['state'],
                        'address_country' => $userData['address']['country'],
                        'address_lat' => $userData['address']['coordinates']['lat'],
                        'address_lng' => $userData['address']['coordinates']['lng'],
                        'credit_card_number' => $userData['credit_card']['cc_number'],
                        'subscription_plan' => $userData['subscription']['plan'],
                        'subscription_status' => $userData['subscription']['status'],
                        'subscription_payment_method' => $userData['subscription']['payment_method'],
                        'subscription_term' => $userData['subscription']['term'],
                    ]);
                    $this->info("Usuario {$userData['uid']} actualizado.");
                    $updated++;
                } else {
                    // Si el usuario no existe, se crea
                    User::create([
                        'uid' => $userData['uid'],
                        'password' => bcrypt($userData['password']),
                        'first_name' => $userData['first_name'],
                        'last_name' => $userData['last_name'],
                        'username' => $userData['username'],
                        'email' => $userData['email'],
                        'avatar' => $userData['avatar'],
                        'gender' => $userData['gender'],
                        'phone_number' => $userData['phone_number'],
                        'social_insurance_number' => $userData['social_insurance_number'],
                        'date_of_birth' => $userData['date_of_birth'],
                        'employment_title' => $userData['employment']['title'],
                        'employment_key_skill' => $userData['employment']['key_skill'],
                        'address_city' => $userData['address']['city'],
                        'address_street_name' => $userData['address']['street_name'],
                        'address_street_address' => $userData['address']['street_address'],
                        'address_zip_code' => $userData['address']['zip_code'],
                        'address_state' => $userData['address']['state'],
                        'address_country' => $userData['address']['country'],
                        'address_lat' => $userData['address']['coordinates']['lat'],
                        'address_lng' => $userData['address']['coordinates']['lng'],
                        'credit_card_number' => $userData['credit_card']['cc_number'],
                        'subscription_plan' => $userData['subscription']['plan'],
                        'subscription_status' => $userData['subscription']['status'],
                        'subscription_payment_method' => $userData['subscription']['payment_method'],
                        'subscription_term' => $userData['subscription']['term'],
                    ]);
                    $this->info("Usuario {$userData['uid']} insertado.");
                    $inserted++;
                }
            }
            $this->info("Inserted: $inserted, Updated: $updated");
        } else {
            $this->error('Error al obtener los usuarios desde la API.');
        }
    }
}
