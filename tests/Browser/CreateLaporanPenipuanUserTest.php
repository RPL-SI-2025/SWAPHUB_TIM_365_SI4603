<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateLaporanPenipuanUserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
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
                    ->clickLink('Fraud Report')
                    ->clickLink('Tambah Laporan')
                    ->select('#id_kategori', 10)
                    ->select('#id_dilapor', 6)
                    ->type('pesan_laporan', 'Test Lapor')
                    ->attach('foto_bukti', __DIR__ . '/files/bukti_penipuan.jpg')
                    ->press('Kirim Laporan')
                    ->assertSee('Laporan penipuan telah dikirim!');
        });
    }
}
