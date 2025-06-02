<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Barang;
use App\Models\History;
use App\Models\Kategori;
use App\Models\Penukaran;
use App\Models\RatingPengguna;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HistoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $admin;
    protected $user1;
    protected $user2;
    protected $kategori;
    protected $barang1;
    protected $barang2;
    protected $penukaran;
    protected $history;
    protected $rating;

    public function setUp(): void
    {
        parent::setUp();

        // Buat admin
        $this->admin = User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'role' => 'admin',
            'phone' => '081234567890'
        ]);

        // Buat user biasa
        $this->user1 = User::create([
            'email' => 'user1@example.com',
            'password' => bcrypt('password123'),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'role' => 'user',
            'phone' => '081234567891'
        ]);

        $this->user2 = User::create([
            'email' => 'user2@example.com',
            'password' => bcrypt('password123'),
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'role' => 'user',
            'phone' => '081234567892'
        ]);

        // Buat kategori
        $this->kategori = Kategori::create([
            'nama_kategori' => 'Elektronik',
            'jenis_kategori' => 'barang'
        ]);

        // Buat barang
        $this->barang1 = Barang::create([
            'nama_barang' => 'Laptop Gaming',
            'deskripsi_barang' => 'Laptop gaming merk terkenal',
            'id_kategori' => $this->kategori->id_kategori,
            'id_user' => $this->user1->id,
            'status_barang' => 'tersedia'
        ]);

        $this->barang2 = Barang::create([
            'nama_barang' => 'Smartphone Android',
            'deskripsi_barang' => 'HP Android terbaru',
            'id_kategori' => $this->kategori->id_kategori,
            'id_user' => $this->user2->id,
            'status_barang' => 'tersedia'
        ]);

        // Buat penukaran
        $this->penukaran = Penukaran::create([
            'id_penawar' => $this->user1->id,
            'id_ditawar' => $this->user2->id,
            'id_barang_penawar' => $this->barang1->id_barang,
            'id_barang_ditawar' => $this->barang2->id_barang,
            'pesan_penukaran' => 'Mau tukar laptop dengan hp',
            'status_penukaran' => 'diterima'
        ]);

        // Buat history
        $this->history = History::create([
            'id_penukaran' => $this->penukaran->id_penukaran
        ]);

        // Buat rating
        $this->rating = RatingPengguna::create([
            'id_penukaran' => $this->penukaran->id_penukaran,
            'id_pemberi_rating' => $this->user1->id,
            'id_penerima_rating' => $this->user2->id,
            'rating' => 5,
            'komentar' => 'Penukaran lancar, recommended!'
        ]);
    }

    /**
     * Test login sebagai admin
     * @test
     */
    public function testLoginAdmin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                   ->type('email', 'admin@gmail.com')
                   ->type('password', 'admin123')
                   ->press('Login')
                   ->pause(2000)
                   ->assertPathIs('/home')
                   ->assertSee('Admin User');
        });
    }

    /**
     * Test navigasi ke halaman history
     * @test
     */
    public function testNavigasiKeHistory()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/home')
                   ->clickLink('Trade')
                   ->pause(2000)
                   ->assertPathIs('/penukaran')
                   ->assertSee('Permintaan Tukar Barang')
                   ->clickLink('History')
                   ->pause(2000)
                   ->assertPathIs('/history')
                   ->assertSee('Riwayat Penukaran');
        });
    }

    /**
     * Test fitur pencarian di history
     * @test
     */
    public function testPencarianHistory()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/history')
                   ->pause(2000)
                   ->type('search', 'Laptop Gaming')
                   ->pause(2000)
                   ->assertSee('Laptop Gaming')
                   ->assertDontSee('Smartphone Android');
        });
    }

    /**
     * Test filter kategori
     * @test
     */
    public function testFilterKategori()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/history')
                   ->pause(2000)
                   ->select('kategori', $this->kategori->nama_kategori)
                   ->pause(2000)
                   ->assertSee('Elektronik')
                   ->assertSee('Laptop Gaming')
                   ->assertSee('Smartphone Android');
        });
    }

    /**
     * Test filter tanggal
     * @test
     */
    public function testFilterTanggal()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/history')
                   ->pause(2000)
                   ->type('tanggal', date('m/d/Y'))
                   ->pause(2000)
                   ->assertSee('Laptop Gaming')
                   ->assertSee('Smartphone Android');
        });
    }

    /**
     * Test tombol reset filter
     * @test
     */
    public function testResetFilter()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/history')
                   ->pause(2000)
                   ->type('search', 'Laptop Gaming')
                   ->select('kategori', $this->kategori->nama_kategori)
                   ->type('tanggal', date('m/d/Y'))
                   ->pause(2000)
                   ->press('Reset Filter')
                   ->pause(2000)
                   ->assertValue('search', '')
                   ->assertSelected('kategori', 'Semua Kategori')
                   ->assertValue('tanggal', '');
        });
    }

    /**
     * Test lihat detail history
     * @test
     */
    public function testLihatDetailHistory()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/history')
                   ->pause(2000)
                   ->click('.view-detail-btn') // Sesuaikan dengan class button detail
                   ->pause(2000)
                   ->assertPathIs('/history/' . $this->history->id_history)
                   ->assertSee('Detail Riwayat Penukaran')
                   ->assertSee('Laptop Gaming')
                   ->assertSee('Smartphone Android')
                   ->assertSee('Mau tukar laptop dengan hp');
        });
    }

    /**
     * Test tombol navigasi
     * @test
     */
    public function testTombolNavigasi()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/history')
                   ->pause(2000)
                   ->press('Lihat Rating')
                   ->pause(2000)
                   ->assertPathIs('/rating-user')
                   ->back()
                   ->pause(2000)
                   ->press('Kembali ke Penukaran')
                   ->pause(2000)
                   ->assertPathIs('/penukaran');
        });
    }

    /**
     * Test pesan tidak ada hasil pencarian
     * @test
     */
    public function testPesanTidakAdaHasil()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/history')
                   ->pause(2000)
                   ->type('search', 'BarangTidakAda123')
                   ->pause(2000)
                   ->assertSee('Barang tidak ditemukan sesuai pencarian atau filter.');
        });
    }

    /**
     * Test melihat daftar rating
     * @test
     */
    public function testLihatDaftarRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/history')
                   ->pause(2000)
                   ->press('Lihat Rating')
                   ->pause(2000)
                   ->assertPathIs('/rating-user')
                   ->assertSee('Daftar Rating Pengguna')
                   ->assertSee($this->user2->first_name . ' ' . $this->user2->last_name)
                   ->assertSee('5')
                   ->assertSee('Penukaran lancar, recommended!');
        });
    }

    /**
     * Test memberikan rating baru
     * @test
     */
    public function testBeriRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user2)
                   ->visit('/history')
                   ->pause(2000)
                   ->press('Lihat Rating')
                   ->pause(2000)
                   ->press('Beri Rating')
                   ->pause(2000)
                   ->select('rating', '4')
                   ->type('komentar', 'Barang sesuai deskripsi')
                   ->press('Submit')
                   ->pause(2000)
                   ->assertSee('Rating berhasil diberikan')
                   ->assertSee('4')
                   ->assertSee('Barang sesuai deskripsi');
        });
    }

    /**
     * Test edit rating
     * @test
     */
    public function testEditRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/rating-user')
                   ->pause(2000)
                   ->click('.edit-rating-btn') // Sesuaikan dengan class button edit
                   ->pause(2000)
                   ->select('rating', '3')
                   ->type('komentar', 'Update: Barang bagus tapi ada sedikit lecet')
                   ->press('Update')
                   ->pause(2000)
                   ->assertSee('Rating berhasil diupdate')
                   ->assertSee('3')
                   ->assertSee('Update: Barang bagus tapi ada sedikit lecet');
        });
    }

    /**
     * Test hapus rating
     * @test
     */
    public function testHapusRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/rating-user')
                   ->pause(2000)
                   ->click('.delete-rating-btn') // Sesuaikan dengan class button delete
                   ->pause(1000)
                   ->acceptDialog() // Konfirmasi delete
                   ->pause(2000)
                   ->assertSee('Rating berhasil dihapus')
                   ->assertDontSee('Penukaran lancar, recommended!');
        });
    }

    /**
     * Test filter rating berdasarkan rating
     * @test
     */
    public function testFilterRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/rating-user')
                   ->pause(2000)
                   ->select('filter_rating', '5')
                   ->pause(2000)
                   ->assertSee('5')
                   ->assertSee('Penukaran lancar, recommended!')
                   ->select('filter_rating', '1')
                   ->pause(2000)
                   ->assertDontSee('Penukaran lancar, recommended!');
        });
    }

    /**
     * Test pencarian di daftar rating
     * @test
     */
    public function testCariRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/rating-user')
                   ->pause(2000)
                   ->type('search', 'recommended')
                   ->pause(2000)
                   ->assertSee('Penukaran lancar, recommended!')
                   ->type('search', 'tidak ada rating ini')
                   ->pause(2000)
                   ->assertSee('Tidak ada rating yang ditemukan');
        });
    }

    /**
     * Test validasi form rating
     * @test
     */
    public function testValidasiFormRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user1)
                   ->visit('/rating-user')
                   ->pause(2000)
                   ->press('Beri Rating')
                   ->pause(2000)
                   ->press('Submit')
                   ->pause(2000)
                   ->assertSee('Rating harus diisi')
                   ->assertSee('Komentar harus diisi')
                   ->select('rating', '6')
                   ->pause(1000)
                   ->assertSee('Rating tidak valid')
                   ->type('komentar', str_repeat('a', 1001))
                   ->pause(1000)
                   ->assertSee('Komentar tidak boleh lebih dari 1000 karakter');
        });
    }
}
