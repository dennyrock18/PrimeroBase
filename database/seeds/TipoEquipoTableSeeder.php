<?php

use Illuminate\Database\Seeder;

class TipoEquipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoequipos = array('Laptop', 'PC-Desktop');

        foreach ($tipoequipos as $tipoequipo) {

            DB::table('tipo_equipos')->insert(array(
                'tipoequipo' => $tipoequipo
            ));
        }
    }
}
