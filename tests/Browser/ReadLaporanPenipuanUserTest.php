<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReadLaporanPenipuanUserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group ReadLaporanPenipuanUserTest
     */
public function testReadLaporanPenipuanUser(): void
    {
        $this->browse(function (Browser $browser) {
            // Login sebagai pengguna
            $browser->visit('/')
                    ->type('#loginForm input[name="email"]', 'botak@gmail.com')
                    ->type('#loginForm input[name="password"]', '12345678')
                    ->press('Login')
                    ->pause(1000)
                    ->assertPathIs('/home')
                    ->press('#user-menu-button')
                    ->assertSee('Profile')
                    ->visit('/profile')
                    ->assertSee('Fraud Report')
                    ->clickLink('Fraud Report');

        });
    }
}
