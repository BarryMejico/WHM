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
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'name' => 'Barry Mejico',
            'email' => 'barrymejico@gmail.com',
            'password' => Hash::make('barrymejico'),
        ]);

        DB::table('Customers')->insert([
            'Customer'=>'Customer-seed001',
            'Number'=>'09605053',
            'Address'=>'Cavite',
            'Ccode'=>'Seed-001', 
        ]);

        DB::table('vendor_models')->insert([
            'Vendor'=>'Vendor-seed001',
            'Number'=>'09605053',
            'Address'=>'Cavite',
            'Vcode'=>'Seed-001', 
        ]);

        DB::table('Items')->insert([
            'Name'=>'Item-seed001',
            'Unit'=>'Kilo',
            'status'=>'1',
            'Code'=>'001', 
        ]);
    }
}
