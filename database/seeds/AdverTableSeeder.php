<?php

use App\Advertising;
use Illuminate\Database\Seeder;

class AdverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Advertising::class, 950)->create()->make();
    }
}
