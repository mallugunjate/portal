<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        // 
        $this->call(EventTypesTableSeeder::class);
        $this->command->info('Event Types Table seeded!');

        $this->call(EventsTableSeeder::class);
        $this->command->info('Events Table seeded!');

        $this->call(BannerTableSeeder::class);
        $this->command->info('Banner Table seeded!');        

        Model::reguard();
    }
 
}
