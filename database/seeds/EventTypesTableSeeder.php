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

        EventTypes::create(array('event_type' => 'Event Type 1' ));
        EventTypes::create(array('event_type' => 'Event Type 2' ));
        EventTypes::create(array('event_type' => 'Event Type 3' ));
        EventTypes::create(array('event_type' => 'Event Type 4' ));
        EventTypes::create(array('event_type' => 'Event Type 5' ));
        EventTypes::create(array('event_type' => 'Event Type 6' ));
        EventTypes::create(array('event_type' => 'Event Type 7' ));
        EventTypes::create(array('event_type' => 'Event Type 8' ));
        EventTypes::create(array('event_type' => 'Event Type 9' ));
        EventTypes::create(array('event_type' => 'Event Type 10' ));
    }
}
