<?php

use Illuminate\Database\Seeder;

class PlaceStainesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('placestaines')->insert([
            [
                //1
                'title' => 'درب جلو سمت راننده',
            ],
            [
                //2
                'title' => 'درب جلو سمت شاگرد',
            ],
            [
                'title' => 'درب عقب سمت راننده',
            ],
            [
                'title' => 'درب عقب سمت شاگرد',
            ],
            [
                'title' => 'کاپوت',
            ],
            [
                'title' => 'سپر جلو',
            ],
            [
                'title' => 'سپر عقب',
            ],
            [
                'title' => 'صندوق عقب',
            ],
            [
                'title' => 'سقف',
            ],
            [
                'title' => 'گلگیر جلو سمت راننده',
            ],
            [
                'title' => 'گلگیر جلو سمت شاگرد',
            ],
            [
                'title' => 'گلگیر عقب سمت راننده',
            ],
            [
                'title' => 'گلگیر عقب سمت شاگرد',
            ],
            [
                'title' => 'رکاب سمت راننده',
            ],
            [
                'title' => 'رکاب سمت شاگرد',
            ],
            [
                'title' => 'ستون سمت راننده ',
            ],
            [
                'title' => 'ستون سمت شاگرد ',
            ],
        ]);
    }
}
