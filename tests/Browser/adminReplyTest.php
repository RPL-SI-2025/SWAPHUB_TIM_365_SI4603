<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class adminReplyTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group adminReply
     */
    public function testAdminReply(): void
    {
        // $this->browse(callback: function (Browser $browser): void {
        //     $browser->visit('/')
        //         ->type('#loginForm input[name="email"]', 'user@gmail.com')
        //         ->type('#loginForm input[name="password"]', 'user123')
        //         ->press('Login')
        //         ->pause(1000)
        //         ->assertPathIs('/home')
        //         ->visit('/#rating')
        //         ->click('label[for="star5"]')
        //         ->check('is_visible')
        //         ->type('review', 'Test review')
        //         ->press('Submit Feedback');
        // });

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('#loginForm input[name="email"]', 'admin@gmail.com')
                ->type('#loginForm input[name="password"]', 'admin123')
                ->press('Login')
                ->pause(1000)
                ->assertPathIs('/home')
                ->press('#user-menu-button')
                ->assertSee('Dashboard')
                ->clickLink('Dashboard')
                ->assertPathIs('/admin/dashboard')
                ->assertSee('Website Rating')
                ->clickLink('Website Rating')
                ->assertPathIs('/admin/rating')
                ->assertSee('Test review')
                ->clickLink('Reply')
                ->type('tanggapan_review', 'Thank you for your feedback!')
                ->press('Kirim Balasan')
                ->assertSee('Reply submitted successfully.');
        });

        // $this->browse(callback: function (Browser $browser): void {
        //     $browser->visit('/')
        //         ->type('#loginForm input[name="email"]', 'user@gmail.com')
        //         ->type('#loginForm input[name="password"]', 'user123')
        //         ->press('Login')
        //         ->pause(1000)
        //         ->assertPathIs('/home')
        //         ->visit('/#rating')
        //         ->assertSee('Thank you for your feedback!');
        // });
    }
}
