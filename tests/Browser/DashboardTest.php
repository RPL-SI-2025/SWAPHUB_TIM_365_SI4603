<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DashboardTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group dashboard
     */
    public function testDashboard(): void
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
                ->assertSee('Welcome Back');
        });
    }
}
