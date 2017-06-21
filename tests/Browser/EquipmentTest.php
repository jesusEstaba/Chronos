<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Cronos\User;

class EquipmentTest extends DuskTestCase
{
    public $equipmentName;
    private $browser;

    /**
     * @test
     */
    public function booting()
    {
        $this->equipmentName = 'Equipo' . md5(date('H:i:s') . rand(0, 9999));

        $this->browse(function (Browser $browser) {
            $this->browser = $browser->loginAs(User::find(1));

            $this->seeIndexPage();
            $this->create();
            $this->addCost();
            $this->edit();
            $this->search();
            $this->badSearch();
        });
    }

    public function seeIndexPage()
    {
        $this->browser
            ->visit('/equipments')
            ->assertSee('Equipos');
    }

    public function create()
    {
        $this->browser
            ->clickLink('Crear')
            ->type('name', $this->equipmentName)
            ->type('cost', '9.99')
            ->press('Crear')
            ->assertSee($this->equipmentName);
    }

    public function addCost()
    {
        $this->browser
            ->clickLink($this->equipmentName)
            ->type('cost', '45.87')
            ->press('Agregar')
            ->assertSee('45.87');
    }

    public function edit()
    {
        $this->equipmentName = 'Equipo' . md5($this->equipmentName);
        
        $this->browser
            ->clickLink('Editar')
            ->type('name', $this->equipmentName)
            ->press('Actualizar')
            ->clickLink('Atrás')
            ->assertSee($this->equipmentName);
    }

    public function search()
    {
        $this->browser
            ->visit('/equipments')
            ->type('search', $this->equipmentName)
            ->press('Buscar')
            ->assertSee($this->equipmentName);
    }

    public function badSearch()
    {
        $randomText = 'Random' . md5(rand(0, 9999));

        $this->browser
            ->visit('/equipments')
            ->type('search', $randomText)
            ->press('Buscar')
            ->assertSee('No se encontrarón resultados');
    }
}
