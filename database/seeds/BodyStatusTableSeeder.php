<?php

use Illuminate\Database\Seeder;

class BodyStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bodystatus')->insert([
            [
                'title' => 'بدون رنگ',
                'slug' => ''
            ],
            [
                'title' => 'صافکاری بدون رنگ',
                'slug' => ''
            ],
            [
                'title' => 'یک لکه رنگ',
                'slug' => ''
            ],
            [
                'title' => 'دو لکه رنگ',
                'slug' => ''
            ],
            [
                'title' => 'چند لکه رنگ',
                'slug' => ''
            ],
            [
                'title' => 'گلگیر رنگ',
                'slug' => ''
            ],
            [
                'title' => 'گلگیر تعویض',
                'slug' => ''
            ],
            [
                'title' => 'یک درب رنگ',
                'slug' => ''
            ],
            [
                'title' => 'دو درب رنگ',
                'slug' => ''
            ],
            [
                'title' => 'درب تعویض',
                'slug' => ''
            ],
            [
                'title' => 'کاپوت رنگ',
                'slug' => ''
            ],
            [
                'title' => 'کاپوت تعویض',
                'slug' => ''
            ],
            [
                'title' => 'دور رنگ',
                'slug' => ''
            ],
            [
                'title' => 'کامل رنگ',
                'slug' => ''
            ],
            [
                'title' => 'تصادفی',
                'slug' => ''
            ],
            [
                'title' => 'اتاق تعویض',
                'slug' => ''
            ],
            [
                'title' => 'سوخته',
                'slug' => ''
            ],
            [
                'title' => 'اوراقی',
                'slug' => ''
            ],

        ]);
    }
}
