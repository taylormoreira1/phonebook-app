<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');

        $contacts = Contact::all();

        $types = ['Residencial', 'Comercial', 'Celular',  'Whatsapp', 'Fax', 'Outro'];

        for ($i = 0; $i < 150; $i++) {
            $contact = $contacts->random();
            $phone = $faker->numerify($faker->randomElement(['########', '#########']));
            $type = $types[array_rand($types)];
            $ddd = rand(11, 99);

            Phone::create([
                'contact_id' => $contact->id,
                'phone' => $phone,
                'ddd' => $ddd,
                'type' => $type
            ]);
        }
    }
}
