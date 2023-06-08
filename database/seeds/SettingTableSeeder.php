<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('settings')
            ->delete(); // deleting old records.
        DB::table('settings')
            ->truncate(); // Truncating old records.

        $faker = Faker::create();
        \App\Models\Setting::create([
            'main_name' => 'HRM SAAS',
            'mail_from_name' => 'HRM SAAS',
            'mail_from_email' => 'admin@example.com',
            'email' => 'admin@example.com',
            'name' => 'Administrator',
            'contact' => $faker->e164PhoneNumber,
            'address' => $faker->address,
            'admin_theme' => 'blue',
            'currency' => 'USD',
            'currency_symbol' => '$',
            'status' => 'active'
        ]);
    }
}
