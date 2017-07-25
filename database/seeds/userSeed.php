<?php

use Illuminate\Database\Seeder;

use Repo\Company;
use Repo\User;
use Repo\Unit;
use Repo\Category;
use Repo\State;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$companyId = Company::create(['name' => 'Arpia'])->id;

        User::create([
        	'name' => 'Administrador',
        	'email' => 'admin@arpiasoluciones.com.ve',
        	'password' => bcrypt('adminarpia'),
        	'companieId' => $companyId,
            'rol' => 1,
            'state' => 1,
            'identificator'=> '',
            'phone' => '',
            'address' => '',
        ]);

        Unit::create([
        	'name' => 'Unidad',
        	'abbreviature' => 'UND',
        	'companieId' => $companyId,
        ]);

        Category::create([
        	'name' => 'Sin Categoria',
        	'companieId' => $companyId,
        ]);

        State::create([
            'name' => 'borrador'
        ]);
        State::create([
            'name' => 'presupuesto'
        ]);
        State::create([
            'name' => 'iniciado'
        ]);
        State::create([
            'name' => 'cancelado'
        ]);
        State::create([
            'name' => 'finalizado'
        ]);
    }
}
