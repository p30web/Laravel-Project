<?php

use Illuminate\Database\Seeder;

class PropertiesExpertTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonBattery = [
            'battery_rate' => '5.6',
            'battery_description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
            'battery_element' => [
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ] ,
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ] ,
                [
                    'status' => false,
                    'property' => 'این ویژگی منفی است.'
                ]
            ]
        ];
        $jsonMechanic = [
        'mechanic_rate' => '3.4',
        'mechanic_description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
        'mechanic_element' => [
            [
                'status' => true,
                'property' => 'این ویژگی مثبتی است.'
            ] ,
            [
                'status' => true,
                'property' => 'این ویژگی مثبتی است.'
            ] ,
            [
                'status' => false,
                'property' => 'این ویژگی منفی است.'
            ]
        ]
    ];
        $jsonPaint = [
            'paint_rate' => '10',
            'paint_description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
            'paint_element' => [
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ] ,
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ] ,
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ]
            ]
        ];
        $jsonElectric = [
            'electric_rate' => '5.0',
            'electric_description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
            'electric_element' => [
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ] ,
                [
                    'status' => false,
                    'property' => 'این ویژگی منفی است.'
                ] ,
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ]
            ]
        ];
        $jsonSafety = [
            'safety_rate' => '5.0',
            'safety_description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
            'safety_element' => [
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ] ,
                [
                    'status' => false,
                    'property' => 'این ویژگی منفی است.'
                ] ,
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ]
            ]
        ];
        $jsonWheels = [
            'wheels_rate' => '5.0',
            'wheels_description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
            'wheels_element' => [
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ] ,
                [
                    'status' => false,
                    'property' => 'این ویژگی منفی است.'
                ] ,
                [
                    'status' => true,
                    'property' => 'این ویژگی مثبتی است.'
                ]
            ]
        ];

        DB::table('properties_expert')->delete();
        DB::table('properties_expert')->insert(
            [
                'expert_id' =>1,
                'health_rating' => '6.4',
                'battery_health' => json_encode($jsonBattery , JSON_UNESCAPED_UNICODE),
                'mechanic' => json_encode($jsonMechanic , JSON_UNESCAPED_UNICODE),
                'paint' => json_encode($jsonPaint , JSON_UNESCAPED_UNICODE),
                'electric' => json_encode($jsonElectric , JSON_UNESCAPED_UNICODE),
                'safety' => json_encode($jsonSafety, JSON_UNESCAPED_UNICODE),
                'wheels' => json_encode($jsonWheels, JSON_UNESCAPED_UNICODE),
            ]
        );
    }
}
