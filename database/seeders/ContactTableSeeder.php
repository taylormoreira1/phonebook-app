<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;


class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = FakerFactory::create('pt_BR');

        for ($i = 0; $i < 30; $i++) {
            Contact::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'cpf' => $faker->unique()->cpf(false),
            ]);
        }
    }
}
