<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RatePlatTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group RatePlat
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->type('#loginForm input[name="email"]', 'user@gmail.com')
                    ->type('#loginForm input[name="password"]', 'user123')
                    ->press('Login')
                    ->pause(1000)
                    ->assertPathIs('/home')
                    ->assertSee('SWAP')
                    ->clickLink('SWAP')
                    ->assertPathIs('/')
                    ->visit('/#review')
                    ->pause(1000)
                    // ->type('message', 'Test Rating Website')
                    // ->check('is_visible')
                    ->click('#star input[value="5"]')
                    ;

        });
    }
}
