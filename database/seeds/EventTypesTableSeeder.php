<?php

use Illuminate\Database\Seeder;
use App\EventTypes;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_types')->delete();

        EventTypes::create(array('id' => '1', 'event_type' => 'Event Type 1' ));
        EventTypes::create(array('id' => '2', 'event_type' => 'Event Type 2' ));
        EventTypes::create(array('id' => '3', 'event_type' => 'Event Type 3' ));
        EventTypes::create(array('id' => '4', 'event_type' => 'Event Type 4' ));
        EventTypes::create(array('id' => '5', 'event_type' => 'Event Type 5' ));
        EventTypes::create(array('id' => '6', 'event_type' => 'Event Type 6' ));
        EventTypes::create(array('id' => '7', 'event_type' => 'Event Type 7' ));
        EventTypes::create(array('id' => '8', 'event_type' => 'Event Type 8' ));
        EventTypes::create(array('id' => '9', 'event_type' => 'Event Type 9' ));
    }
}
