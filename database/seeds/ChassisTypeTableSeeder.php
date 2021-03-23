<?php

use Illuminate\Database\Seeder;

class ChassisTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chassis_types')->insert([
            [
                'title' => 'سواری',
                'slug' => 'riding',
            ],
            [
                'title' => 'شاسی بلند',
                'slug' => 'suv',
            ],
            [
                'title' => 'وانت',
                'slug' => 'wanet',
            ],
            [
                'title' => 'کوپه',
                'slug' => 'coupe',
            ],
            [
                'title' => 'کروک',
                'slug' => 'croke',
            ],
            [
                'title' => 'ون',
                'slug' => 'van',
            ],
        ]);
    }
}
