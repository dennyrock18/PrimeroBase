<?php


use App\User;
use Faker\Generator;

class UserTableSeeder extends BaseSeeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->createAdmin();
        $this->createMultiple(9);
    }

    public function getModel()
    {
        return new User;
    }

    private function createAdmin()
    {
        $this->create([

            'fullname' => 'Denny Lopez',
            'id_user' => '1234567891',
            'email' => 'admin@demo.com',
            'password' => 'admin123',
            'phone' => '(305)-213-2222',

            'streetAddress' => '605 sw 24 ave',
            'secundaryAddress' => '',
            'city_id' => '135',
            'postCode' => '',
            'role' => 'admin',
            'terminado'=>'0',

        ]);
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [

            'fullname' => $faker->name,
            'id_user' => $faker->ean13,
            'email' => $faker->email,
            //se quita la propiedad bcrypt puesto que en el modelo User se esta incriptando ya el password
            'password' => '123456',//bcrypt('123456'),
            'phone' => $faker->phoneNumber,

            'streetAddress' => $faker->streetAddress,
            'secundaryAddress' => $faker->streetAddress,

            'postCode' => $faker->postcode,
            'role' => $faker->randomElement(['user','chofer']),
            'terminado'=>'0',
            'fecha_entrega' => null,
            'city_id' => '135',
            'activo'=> '1',
            'conectado' => '0',


        ];
    }
}
