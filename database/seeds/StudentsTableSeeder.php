<?php

use Illuminate\Database\Seeder;
use App\Student;
use Illuminate\Support\Str;
use Faker\Factory;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Student::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'code' => Str::random(6),
            ]);
        }

    }
}
