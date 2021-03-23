<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            [
                'title' => 'قرمز',
                'slug' => 'red',
            ],
            [
                'title' => 'سبز',
                'slug' => 'green',
            ],
            [
                'title' => 'آبی',
                'slug' => 'blue',
            ],
            [
                'title' => 'مشکی',
                'slug' => 'black',
            ],
            [
                'title' => 'طوسی',
                'slug' => 'gray',
            ],
            [
                'title' => 'استخوانی',
                'slug' => 'bone',
            ],
            [
                'title' => 'سفید',
                'slug' => 'white',
            ],
            [
                'title' => 'بِیژ',
                'slug' => 'beige',
            ],
            [
                'title' => 'کرمی',
                'slug' => 'cream',
            ],
            [
                'title' => 'زرد کهربایی',
                'slug' => 'amber',
            ],
            [
                'title' => 'سبز دودی',
                'slug' => 'teal',
            ],
            [
                'title' => 'سبز زیتونی',
                'slug' => 'olive',
            ],
            [
                'title' => 'زرد',
                'slug' => 'yellow',
            ],
            [
                'title' => 'نارنجی',
                'slug' => 'orange',
            ],
            [
                'title' => 'صورتی',
                'slug' => 'pink',
            ],
            [
                'title' => 'بنفش',
                'slug' => 'violet',
            ],
            [
                'title' => 'آبی کاربنی',
                'slug' => 'navy',
            ],
            [
                'title' => 'آبی آسمانی',
                'slug' => 'sky blue',
            ],
            [
                'title' => 'فیروزه ای',
                'slug' => 'turquoise',
            ],
            [
                'title' => 'نقره ای',
                'slug' => 'silver',
            ],
            [
                'title' => 'طلایی',
                'slug' => 'gold',
            ],
            [
                'title' => 'مسی',
                'slug' => 'copper',
            ],
            [
                'title' => 'خاکستری',
                'slug' => 'ashy',
            ],
            [
                'title' => 'قهوه ای',
                'slug' => 'brown',
            ],
            [
                'title' => 'آلبالویی',
                'slug' => 'cranberry',
            ],
            [
                'title' => 'سرمه ای',
                'slug' => 'navy blue',
            ],
            [
                'title' => 'صدفی',
                'slug' => 'shells',
            ]
        ]);
    }
}
