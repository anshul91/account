<?php

use Illuminate\Database\Seeder;

class customers_type extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers_type')->insert([
            'type' => 'walkin',
            'created_by' => 1,
            'created_at' => date('Y-m-d')
        ]);
        DB::table('customers_type')->insert([
            'type' => 'regular',
            'created_by' => 1,
            'created_at' => date('Y-m-d')
        ]);
    }
}
