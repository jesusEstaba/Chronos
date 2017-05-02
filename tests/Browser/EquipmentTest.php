<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Cronos\User;

class EquipmentTest extends DuskTestCase
{
    public $equipmentName;

    public function testBooting()
    {
        $this->equipmentName = 'Equipo' . md5(date('H:i:s') . rand(0, 9999));

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));

            $this->seeIndexPage($browser);
            $this->create($browser);
            $this->addCost($browser);
            $this->edit($browser);
            $this->search($browser);
            $this->badSearch($browser);
        });
    }

    public function seeIndexPage(Browser $browser)
    {
        $browser->visit('/equipments')
                ->assertSee('Equipos');
    }

    public function create(Browser $browser)
    {
        $browser->clickLink('Crear')
                ->type('name', $this->equipmentName)
                ->type('cost', '9.99')
                ->press('Crear')
                ->assertSee($this->equipmentName);
    }

    public function addCost(Browser $browser)
    {
        $browser->clickLink($this->equipmentName)
                ->type('cost', '45.87')
                ->press('Agregar')
                ->assertSee('45.87');
    }

    public function edit(Browser $browser)
    {
        $this->equipmentName = 'Equipo' . md5($this->equipmentName);
        
        $browser->clickLink('Editar')
                ->type('name', $this->equipmentName)
                ->press('Actualizar')
                ->clickLink('Atrás')
                ->assertSee($this->equipmentName);
    }

    public function search(Browser $browser)
    {
        $browser->visit('/equipments')
                ->type('search', $this->equipmentName)
                ->press('Buscar')
                ->assertSee($this->equipmentName);
    }

    public function badSearch(Browser $browser)
    {
        $randomText = 'Random' . md5(rand(0, 9999));

        $browser->visit('/equipments')
                ->type('search', $randomText)
                ->press('Buscar')
                ->assertSee('No se encontrarón resultados');
    }
}
