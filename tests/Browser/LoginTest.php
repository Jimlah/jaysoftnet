<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Laravel');
        });
    }


    public function test_user_can_login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('username', 'admin')
                ->type('password', 'pass')
                ->press('Log in')
                ->assertPathIs('/dashboard');
        });
    }
}
