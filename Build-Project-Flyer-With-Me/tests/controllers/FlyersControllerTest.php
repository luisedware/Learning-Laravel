<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FlyersControllerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function is_shows_the_form_to_create_a_new_flyer()
    {
        $this->visit('flyers/create');
    }
}
