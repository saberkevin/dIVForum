<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mtr_categories')->insert([
            'name' => 'General',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' =>  \Carbon\Carbon::now()
        ]);
    }
}
