<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mtr_roles')->insert([
            'name' => 'Admin',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' =>  \Carbon\Carbon::now()
        ]);

        DB::table('mtr_roles')->insert([
            'name' => 'Member',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' =>  \Carbon\Carbon::now()
        ]);
    }
}
