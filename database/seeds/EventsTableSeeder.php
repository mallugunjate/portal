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
            
            $times = $this->fakeStartEndTimes();
            $start = $times["start"];
            $end = $times["end"];

            DB::table('events')->insert(array(
                'title' => $faker->sentence,
                'description' => $faker->paragraph(3),
                'event_type' => $faker->numberBetween(1,9),
                'start' => $start,
                'end' => $end
            ));
        }
    }

    public function fakeStartEndTimes()
    {
        $most_past = time() - (30 * 24 * 60 * 60); 
        $most_future = time() + (30 * 24 * 60 * 60); 

        $starttime = rand($most_past, $most_future);
        $endtime = rand($most_past, $most_future);

        if($starttime > $endtime){
            $endtime = rand($starttime, $most_future);
        }

        $times = array("start" => $starttime, "end" => $endtime);
        return $times;
    }

}
