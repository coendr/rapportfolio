<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->delete();
        DB::table('admin')->insert(
            ['adminid' => 1, 'userid' => 6, 'naam'=>'Polsstok Admin']
        );
    }
}
