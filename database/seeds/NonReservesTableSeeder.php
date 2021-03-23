<?php

use Illuminate\Database\Seeder;

class NonReservesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nonreserves')->insert([
            [
                'date' =>'1398/02/15',
                'description' => 'به دلیل عید فلان',
                'location_id' => 1,
            ],
        ]);
    }
}
