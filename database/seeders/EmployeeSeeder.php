<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $companyIds = DB::table('companies')->pluck('id')->toArray();

        if (empty($companyIds)) {
            $this->command->warn('No companies found. Please seed the companies table first.');
            return;
        }
        
        $firstNamesHindi = ['आदित्य', 'आर्यन', 'साक्षी', 'प्रिया', 'रोहित', 'अदिति'];
        $lastNamesHindi = ['कुमार', 'शर्मा', 'सिंह', 'जैन', 'गुप्ता', 'मिश्र'];

        for ($i = 0; $i < 20; $i++) {
            DB::table('employees')->insert([
                'company_id' => $faker->randomElement($companyIds),
                'first_name_en' => $faker->firstName,
                'first_name_hi' => $faker->randomElement($firstNamesHindi),
                'last_name_en'  => $faker->lastName,
                'last_name_hi'  => $faker->randomElement($lastNamesHindi),
                'email'         => $faker->unique()->safeEmail,
                'phone'         => $faker->phoneNumber,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
