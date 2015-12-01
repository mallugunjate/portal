<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->delete();

        $faker = Faker\Factory::create();

        for($i = 0; $i < 100; $i++) {
        
        //  $customers = Customer::create(array(
            DB::table('events')->insert(array(
                'title' => $faker->sentence,
                'description' => $faker->sentences,
                'event_type' => $faker->randomDigit,
                'start' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+ 3 momnths'),
                'end' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+ 3 months')
            ));
        }
    }
}
