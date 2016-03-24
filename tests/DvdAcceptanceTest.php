<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DvdAcceptanceTest extends TestCase
{
    /**
     * An acceptance test to see if the Dvd result page can be reached from the dvds/search page,
     *looking for Children of Men title, DVD genre and rating were left at default values
     * @return void
     */
    public function testFindDvdResultsFromDvdSearchPage()
    {
      $this->visit('/dvds/search')
        ->type('Children of Men', 'dvd_title')
        ->press('submitButton')
        ->seePageIs('/dvds?dvd_genre=Action&dvd_rating=G&dvd_title=Children%20of%20Men');
    }
}
