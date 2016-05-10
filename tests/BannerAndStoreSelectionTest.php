<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BannerAndStoreSelectionTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testDropDownIsPopulated()
    {
        $this->visit('/')
             ->see('Select Your Banner')
             ->select("1", "bannerSelect")
             ->select("0392", "storeSelect")
             ->seePageIs('/0392');

        //$this->click('bannerSelect')
    }
}
