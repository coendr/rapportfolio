<?php

use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(array(
            array('id'=>'1','username'=>'leerling1','password'=>'$2y$10$k7x1HuBzIU6ANJ2fyrhA6.rrulsrh4n1Z7Tow7M5Fe774Dg3Jdahi','email'=>'leerling@test.com','role'=>'leerling','force_password_change'=>'0'),
            array('id'=>'2','username'=>'leerling2','password'=>'$2y$10$k7x1HuBzIU6ANJ2fyrhA6.rrulsrh4n1Z7Tow7M5Fe774Dg3Jdahi','email'=>'leerling2@test.com','role'=>'leerling','force_password_change'=>'0'),
            array('id'=>'3','username'=>'leerling3','password'=>'$2y$10$k7x1HuBzIU6ANJ2fyrhA6.rrulsrh4n1Z7Tow7M5Fe774Dg3Jdahi','email'=>'leerling3@test.com','role'=>'leerling','force_password_change'=>'0'),
            array('id'=>'4','username'=>'leerkracht','password'=>'$2y$10$k7x1HuBzIU6ANJ2fyrhA6.rrulsrh4n1Z7Tow7M5Fe774Dg3Jdahi','email'=>'leerkracht@test.com','role'=>'leerkracht','force_password_change'=>'0'),
            array('id'=>'5','username'=>'ouder','password'=>'$2y$10$k7x1HuBzIU6ANJ2fyrhA6.rrulsrh4n1Z7Tow7M5Fe774Dg3Jdahi','email'=>'ouder@test.com','role'=>'ouder','force_password_change'=>'0'),
            array('id'=>'6','username'=>'admin','password'=>'$2y$10$k7x1HuBzIU6ANJ2fyrhA6.rrulsrh4n1Z7Tow7M5Fe774Dg3Jdahi','email'=>'admin@test.com','role'=>'admin','force_password_change'=>'0'),
            array('id'=>'7','username'=>'leerkrachtgym','password'=>'$2y$10$k7x1HuBzIU6ANJ2fyrhA6.rrulsrh4n1Z7Tow7M5Fe774Dg3Jdahi','email'=>'leerkrachtgym@test.com','role'=>'leerkachtgym','force_password_change'=>'0'),

        ));
    }
};


