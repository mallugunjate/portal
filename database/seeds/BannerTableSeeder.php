<?php

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->delete();

        Banner::create(array( 'name' => 'Sport Chek' ));
        Banner::create(array( 'name' => 'Atmosphere' ));
        Banner::create(array( 'name' => 'Marks' ));

    }
}
