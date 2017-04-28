<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Cronos\User;

class MaterialTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateMaterial()
    {
        $this->browse(function (Browser $browser) {
            $materialName = 'Material' . md5(rand(0, 999));

            $browser->loginAs(User::find(1))
                    ->visit('/materials')
                    ->clickLink('Crear')
                    ->type('name', $materialName)
                    ->type('cost', '9.99')
                    ->press('Crear')
                    ->assertSee($materialName);
        });
    }
}
