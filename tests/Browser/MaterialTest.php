<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Cronos\User;

class MaterialTest extends DuskTestCase
{
    private $browser;

    /**
     * @test
     */
    public function booting()
    {
        $materialName = 'Material' . md5(rand(0, 999));

        $this->browse(function (Browser $browser) {
            $this->browser = $browser->loginAs(User::find(1));
            
            $this->create();
            $this->isCreated();
            $this->createWithInvalidFields();
            $this->edit();
            $this->isEdited();
            $this->editWithInvalidFields();
            $this->search();
            $this->fakeSearch();
            $this->show();
            $this->showWithFakeId();
        });
    }

    public function create()
    {
        $this->browser
            ->loginAs(User::find(1))
            ->visit('/materials')
            ->clickLink('Crear')
            ->type('name', $materialName)
            ->type('cost', '9.99')
            ->press('Crear')
            ->assertSee($materialName);
    }

    public function isCreated()
    {
        $this->browser
            ->visit('/materials')
            ->assertSee('Material');
    }

    public function createWithInvalidFields()
    {
        $this->browser;
    }

    public function edit()
    {
        $this->browser;
    }

    public function isEdited()
    {
        $this->browser;
    }

    public function editWithInvalidFields()
    {
        $this->browser;
    }

    public function search()
    {
        $this->browser;
    }

    public function fakeSearch()
    {
        $this->browser;
    }

    public function show()
    {
        $this->browser;
    }

    public function showWithFakeId()
    {
        $this->browser;
    }
}
