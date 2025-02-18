<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $hindiCompanies = [
            'टाटा समूह',
            'भारती एंटरप्राइजेज',
            'महिंद्रा एंड महिंद्रा',
            'अदानी समूह',
            'इनफोसिस',
            'विप्रो',
            'हिंदुस्तान यूनिलीवर',
            'लार्सन एंड टुब्रो',
            'बजाज ऑटो',
            'आधार',
        ];
        for ($i = 0; $i < 20; $i++) {
            DB::table('companies')->insert([
                'name_en'     => $faker->company,
                'name_hi'     => $hindiCompanies[array_rand($hindiCompanies)],
                'email'       => $faker->unique()->safeEmail,
                'website'     => $faker->url,
                'logo'        => $faker->imageUrl(200, 200, 'business', true, 'Company'),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
