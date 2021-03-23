<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            'name' => 'مشاهده لیست آگهی های کارشناسی',
            'slug' => 'viewExpertsList',
            'resource' => 'system',
            'system' => 'true',
        ]);

        DB::table('permissions')->insert([
            'name' => 'ویرایش آگهی های کارشناسی',
            'slug' => 'editExpertAdver',
            'resource' => 'system',
            'system' => 'true',
        ]);

        DB::table('roles')->insert([
            'name' => 'مدیریت سایت',
            'slug' => 'administrator',
            'description' => 'دسترسی کلی به همه قسمت های سایت',
            'system' => 'true',
        ]);

        DB::table('roles')->insert([
            'name' => 'کارشناس سایت',
            'slug' => 'expertUser',
            'description' => 'دسترسی به قسمت کارشناسی سایت',
            'system' => 'true',
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 1,
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 1,
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);

        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 2,
        ]);

    }
}
