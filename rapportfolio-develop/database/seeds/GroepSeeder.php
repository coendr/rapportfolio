<?php

use Illuminate\Database\Seeder;

class GroepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groep')->delete();
        DB::table('groep')->insert(array(
            array('groepid' => 1, 'naam' => '3A', 'groep' => '3'),
            array('groepid' => 2, 'naam' => '3B', 'groep' => '3'),
            array('groepid' => 3, 'naam' => '4A', 'groep' => '4'),
            array('groepid' => 4, 'naam' => '4B', 'groep' => '4'),
            array('groepid' => 5, 'naam' => '5A', 'groep' => '5'),
            array('groepid' => 6, 'naam' => '5B', 'groep' => '5'),
            array('groepid' => 7, 'naam' => '6A', 'groep' => '6'),
            array('groepid' => 8, 'naam' => '6B', 'groep' => '6'),
            array('groepid' => 9, 'naam' => '7A', 'groep' => '7'),
            array('groepid' => 10, 'naam' => '7B', 'groep' => '7'),
            array('groepid' => 11, 'naam' => '8A', 'groep' => '8'),
            array('groepid' => 12, 'naam' => '8B', 'groep' => '8'),
            array('groepid' => 13, 'naam' => 'van school', 'groep' => 'van school'),
    ));
    }
}
