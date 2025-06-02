<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RekomendasiTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group Rekomendasiadmin
     */
    public function testRekomendasiadmin(): void
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
                ->click('.flex.items-center.p-2.rounded-lg.group svg[viewBox="0 0 18 20"]')
                ->waitForText('Item Recommendations')
                ->assertPathIs('/admin/rekomendasi')
                ->assertSee('Manajemen Rekomendasi Barang');
        });
    }
    
}
