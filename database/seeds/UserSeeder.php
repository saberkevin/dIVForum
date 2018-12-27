<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mtr_users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'phone' => '123456789012',
            'gender' => 'Male',
            'address' => 'Some Randomly Picked Address From Google Maps Street',
            'profile_picture' => '12272018158-admin.png',
            'birthday' => '1945-08-17'
        ]);

        DB::table('trn_user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);

        DB::table('trn_popularities')->insert([
            'user_id' => 1,
            'positive' => 999,
            'negative' => 0,
        ]);
    }
}
