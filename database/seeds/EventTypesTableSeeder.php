<?php

use Illuminate\Database\Seeder;
use App\Models\Event\EventType;

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

        EventType::create(array('id' => '1', 'event_type' => 'Event Type 1' ));
        EventType::create(array('id' => '2', 'event_type' => 'Event Type 2' ));
        EventType::create(array('id' => '3', 'event_type' => 'Event Type 3' ));
        EventType::create(array('id' => '4', 'event_type' => 'Event Type 4' ));
        EventType::create(array('id' => '5', 'event_type' => 'Event Type 5' ));
        EventType::create(array('id' => '6', 'event_type' => 'Event Type 6' ));
        EventType::create(array('id' => '7', 'event_type' => 'Event Type 7' ));
        EventType::create(array('id' => '8', 'event_type' => 'Event Type 8' ));
        EventType::create(array('id' => '9', 'event_type' => 'Event Type 9' ));
    }
}
