<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserSeeder::class);
        $this->call(OuderSeeder::class);
        $this->call(GroepSeeder::class);
        $this->call(LeerlingSeeder::class);
        $this->call(LeerkrachtSeeder::class);
        $this->call(RapportSeeder::class);
        $this->call(VakSeeder::class);
        $this->call(KnapSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
