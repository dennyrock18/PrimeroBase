<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->truncateTables(array(

            'users',
            'states',
            'equipos',
            'tipo_equipos',

        ));

        $this->call(StateTableSeeder::class);
        $this->call(TipoEquipoTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EquipoTableSeeder::class);

        Model::reguard();
    }

    private function truncateTables(array $tables)
    {
        $this->checkForeignKeys(false);

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        $this->checkForeignKeys(true);
    }

    private function checkForeignKeys($check)
    {
        $check = $check ? '1' : '0';

        DB::statement('SET FOREIGN_KEY_CHECKS ='.$check);
    }
}
