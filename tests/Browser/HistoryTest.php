<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class SimpleLoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_login_and_see_homepage()
    {
        // Buat user manual
        $this->browse(callback: function (Browser $browser): void {
            $browser->visit('/')
                ->type('#loginForm input[name="email"]', 'user@gmail.com')
                ->type('#loginForm input[name="password"]', 'user123')
                ->press('Login')
                ->pause(1000)
                ->assertPathIs('/home')
                ->visit('/#rating')
                ->click('label[for="star5"]')
                ->check('is_visible')
                ->type('review', 'Test review')
                ->press('Submit Feedback');
        });
    }
}
