<?php

use Illuminate\Database\Seeder;

class VakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vak')->delete();
        DB::table('vak')->insert(array(
            array('vakid' => 1, 'naam' => 'rekenen','groep' => 3),
            array('vakid' => 2, 'naam' => 'rekenen','groep' => 4),
            array('vakid' => 3, 'naam' => 'rekenen','groep' => 5),
            array('vakid' => 4, 'naam' => 'rekenen','groep' => 6),
            array('vakid' => 5, 'naam' => 'rekenen','groep' => 7),
            array('vakid' => 6, 'naam' => 'rekenen','groep' => 8),
            array('vakid' => 7, 'naam' => 'technisch lezen','groep' => 3),
            array('vakid' => 8, 'naam' => 'begrijpend lezen','groep' => 8),
        ));
    }
}
