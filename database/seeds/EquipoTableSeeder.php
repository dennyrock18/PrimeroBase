<?php

use App\Equipo;
use Illuminate\Database\Seeder;

class EquipoTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createMultiple(20);
    }

    public function getModel()
    {
        return new Equipo;
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            's_n' => $faker->swiftBicNumber,
            'model' => $faker->randomElement(['PC-', 'Lap-']) .$faker-> swiftBicNumber,

            'user_id' => $this->getRandom('User')->id,
            'tipo_equipos_id' =>  $faker->randomElement(['1', '2'])
            ];
    }
}
