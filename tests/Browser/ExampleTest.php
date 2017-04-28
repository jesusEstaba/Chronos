<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Cronos\User;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Inicie Sesión');
        });
    }

    public function testDashboard()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                  ->visit('/dashboard')
                  ->assertSee('Dashboard Master Race');
        });
    }
}
