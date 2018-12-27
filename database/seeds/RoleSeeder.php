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
            'name' => 'Admin'
        ]);

        DB::table('mtr_roles')->insert([
            'name' => 'Member'
        ]);
    }
}
