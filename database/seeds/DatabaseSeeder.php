<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        

        DB::table('locaions')->insert([
            'code'=>'0',
            'name'=>'Local warehouse',
            'parent'=>'root',
            
        ]);
        
    }
}
