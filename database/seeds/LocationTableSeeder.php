<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            [
                'place' => 'نیاوران',
                'slug' => 'niavaran',
                'status' => 1,
            ],
            [
                'place' => 'جردن',
                'slug' => 'jordan',
                'status' => 1,
            ]
        ]);
    }
}
