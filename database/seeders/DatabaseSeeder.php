<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\ContactTableSeeder;
use Database\Seeders\PhonesTableSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ContactTableSeeder::class);
        $this->call(PhonesTableSeeder::class);
    }
}
