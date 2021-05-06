<?php

use Illuminate\Database\Seeder;

class basicData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        -//adding basic data
        DB::table('Customers')->insert([
            'Customer'=>'Customer-seed001',
            'Number'=>'09605053',
            'Address'=>'Cavite',
            'Ccode'=>'Seed-001', 
            'user_id'=>'1',
            'CoCode'=>'company-code-001',
        ]);

        DB::table('vendor_models')->insert([
            'Vendor'=>'Vendor-seed001',
            'Number'=>'09605053',
            'Address'=>'Cavite',
            'Vcode'=>'Seed-001',
            'user_id'=>'1',
            'CoCode'=>'company-code-001',
        ]);
        
        
        DB::table('Items')->insert([
            'Name'=>'Item-seed001',
            'Unit'=>'Kilo',
            'status'=>'1',
            'Code'=>'001', 
            'user_id'=>'1',
            'CoCode'=>'company-code-001',
        ]);
//adding basic data
    }
}
