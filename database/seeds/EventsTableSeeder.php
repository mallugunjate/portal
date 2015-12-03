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
        $year = "2015";
        $month = "12";
        $day = "";

        $startday = rand(1,31);
        $endday = rand($startday,31);

        $multiday = rand(1,4);

        //it's a multiday event (~25% of the dates)
        if($multiday == 4){
            $start = $year . "-" . $month . "-" . $startday;
            $end = $year . "-" . $month . "-" . $endday;
            $dates = array("start" => $start, "end" => $end);
            return $dates;
        } else {
        //single day event
            $start = $year . "-" . $month . "-" . $startday;
            $dates = array("start" => $start, "end" => NULL);
            return $dates;
        }

        

        
        return $times;
    }

}
