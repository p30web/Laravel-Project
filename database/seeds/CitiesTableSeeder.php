<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'title' => 'تهران',
                'slug' => 'tehran',
            ],
            [
                'title' => 'آذربایجان شرقی',
                'slug' => 'azarbayjanSharghi',
            ],
            [
                'title' => 'آذربایجان غربی',
                'slug' => 'azarbayjanGharbi',
            ],
            [
                'title' => 'اردبیل',
                'slug' => 'ardebil',
            ],
            [
                'title' => 'اصفهان',
                'slug' => 'esfahan',
            ],
            [
                'title' => 'ایلام',
                'slug' => 'ilam',
            ],
            [
                'title' => 'بوشهر',
                'slug' => 'boshehr',
            ],

            [
                'title' => 'چهارمحال و بختیاری',
                'slug' => 'chaharmahalVaBakhtiari',
            ],

            [
                'title' => 'خوزستان',
                'slug' => 'khozestan',
            ],
            [
                'title' => 'زنجان',
                'slug' => 'zanjan',
            ],
            [
                'title' => 'سمنان',
                'slug' => 'semnan',
            ],
            [
                'title' => 'سیستان و بلوچستان',
                'slug' => 'sistanVaBalochestan',
            ],    [
                'title' => 'فارس',
                'slug' => 'fars',
            ],
            [
                'title' => 'قزوین',
                'slug' => 'ghazvin',
            ],
            [
                'title' => 'قم',
                'slug' => 'ghom',
            ],
            [
                'title' => 'کردستان',
                'slug' => 'kordestan',
            ],
            [
                'title' => 'کرمان',
                'slug' => 'kerman',
            ],
            [
                'title' => 'کرمانشاه',
                'slug' => 'kermanshah',
            ],
            [
                'title' => 'کهکیلویه وبویراحمد',
                'slug' => 'kohkiloyeVaBoyerahmad',
            ],
            [
                'title' => 'گلستان',
                'slug' => 'golestan',
            ],
            [
                'title' => 'گیلان',
                'slug' => 'gilan',
            ],
            [
                'title' => 'lorestan',
                'slug' => 'لرستان',
            ],
            [
                'title' => 'مازندران',
                'slug' => 'mazandaran',
            ],
            [
                'title' => 'مرکزی',
                'slug' => 'markazi',
            ],
            [
                'title' => 'هرمزگان',
                'slug' => 'hormozgan',
            ],
            [
                'title' => 'همدان',
                'slug' => 'hamedan',
            ],
            [
                'title' => 'یزد',
                'slug' => 'yazd',
            ],
            [
                'title' => 'البرز',
                'slug' => 'alborz',
            ],

            [
                'title' => 'خراسان شمالی',
                'slug' => 'khorasanShomali',
            ],
            [
                'title' => 'خراسان رضوی',
                'slug' => 'khorasanRazavi',
            ],
            [
                'title' => 'خراسان جنوبی',
                'slug' => 'khorasanJonobi',
            ],
        ]);
    }
}
