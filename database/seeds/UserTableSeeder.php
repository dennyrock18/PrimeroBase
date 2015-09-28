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
        $this->createAdmin();
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
            'id_user' => '',
            'email' => 'admin@demo.com',
            'password' => bcrypt('admin123'),
            'phone' => '(305)-213-2222',

            'streetAddress' => '',
            'secundaryAddress' => '',
            //'city_id' => 13,
            'postCode' => '',
            'role' => 'admin',

        ]);
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [

            'fullname' => $faker->name,
            'id_user' => $faker->ean13,
            'email' => $faker->email,
            'password' => bcrypt('123456'),
            'phone' => $faker->phoneNumber,

            'streetAddress' => $faker->streetAddress,
            'secundaryAddress' => $faker->streetAddress,
            //'city_id' => $this->getRandom('Citys')->id,
            //'city_id' => '13',
            'postCode' => $faker->postcode,
            'role' => 'user',//$faker->randomElement(['user','edit']),


        ];
    }
}
