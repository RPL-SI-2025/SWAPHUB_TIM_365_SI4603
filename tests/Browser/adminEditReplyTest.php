<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class adminEditReplyTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group adminEditReply
     */
    public function testExample(): void
    {
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
                ->clickLink('Edit')
                ->type('tanggapan_review', 'So Many Thank you for your feedback!')
                ->press('Kirim Balasan')
                ->assertSee('Reply submitted successfully.');
        });
    }
}
