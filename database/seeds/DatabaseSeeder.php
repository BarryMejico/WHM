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

        DB::table('users')->insert([
            'name' => 'Abi Tolentino',
            'email' => 'abitolentino@gmail.com',
            'password' => Hash::make('abitolentino'),
        ]);

        ///adding company
        DB::table('companies')->insert([
            'CoCode'=>'company-code-001',
            'CompanyName'=>'BarkSpider',
            'CompanyAddress'=>'Cavite City',
            'CompanyOwner'=>'1'
            ]);

            //end company
            
            //sending company invte

            DB::table('invites')->insert([
                'invite_to'=>'1',
                'invite_from'=>'2',
                'CoCode'=>'company-code-001',
                'invite_Status'=>'1',
                ]);

                DB::table('invites')->insert([
                    'invite_to'=>'2',
                    'invite_from'=>'1',
                    'CoCode'=>'company-code-001',
                    'invite_Status'=>'1',
                    ]);
            //end company invte

//adding basic data
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

        DB::table('menus')->insert([
            'menuParent'=>'root',
            'Description'=>'Purchase Order',
            'icon'=>'cart-x',
            'route'=>'/PO', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'root',
            'Description'=>'Data Setup',
            'icon'=>'clipboard',
            'route'=>'0', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'root',
            'Description'=>'Sales',
            'icon'=>'tags',
            'route'=>'0', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'root',
            'Description'=>'Inventory',
            'icon'=>'clipboard-check',
            'route'=>'0', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'root',
            'Description'=>'Reports',
            'icon'=>'clipboard-data',
            'route'=>'0', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'root',
            'Description'=>'Accounting',
            'icon'=>'calculator',
            'route'=>'0', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'root',
            'Description'=>'WareHouse',
            'icon'=>'house-door',
            'route'=>'0', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'root',
            'Description'=>'WareHouse Setup',
            'icon'=>'menu-button-wide',
            'route'=>'/Location', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'2',
            'Description'=>'Vendor',
            'icon'=>'person',
            'route'=>'/Vendor_Create', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'2',
            'Description'=>'Customer',
            'icon'=>'person-fill',
            'route'=>'/Customer_Create', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'2',
            'Description'=>'Items',
            'icon'=>'box-seam',
            'route'=>'/Items_Create', 
        ]);
// -------------------
        DB::table('menus')->insert([
            'menuParent'=>'3',
            'Description'=>'Products',
            'icon'=>'basket',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'3',
            'Description'=>'Service',
            'icon'=>'screwdriver',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'3',
            'Description'=>'Sales Invoice',
            'icon'=>'receipt',
            'route'=>'/invoice', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'3',
            'Description'=>'Job Order',
            'icon'=>'pencil-square',
            'route'=>'/JobOrder', 
        ]);
        // --------------

        DB::table('menus')->insert([
            'menuParent'=>'4',
            'Description'=>'Receiving',
            'icon'=>'clipboard-check',
            'route'=>'/PO_list', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'4',
            'Description'=>'Dispatching',
            'icon'=>'truck',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'4',
            'Description'=>'Returns',
            'icon'=>'arrow-counterclockwise',
            'route'=>'/Upcoming', 
        ]);
//---------------

        DB::table('menus')->insert([
            'menuParent'=>'5',
            'Description'=>'Device Repair History',
            'icon'=>'clock',
            'route'=>'/DeviceHistory', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'5',
            'Description'=>'Sales History',
            'icon'=>'clock-fill',
            'route'=>'/SalesHistory', 
        ]);


        DB::table('menus')->insert([
            'menuParent'=>'5',
            'Description'=>'Job Order History',
            'icon'=>'clock-history',
            'route'=>'/TransactionHistory', 
        ]);

        //--------------------
        DB::table('menus')->insert([
            'menuParent'=>'6',
            'Description'=>'Journals',
            'icon'=>'journal-bookmark-fill',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'6',
            'Description'=>'Cash Flow',
            'icon'=>'cash-stack',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'6',
            'Description'=>'Reports',
            'icon'=>'graph-up',
            'route'=>'/Upcoming', 
        ]);
        //--------------------

        DB::table('menus')->insert([
            'menuParent'=>'7',
            'Description'=>'Receiving',
            'icon'=>'clipboard-check',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'7',
            'Description'=>'Placing/Put-Away',
            'icon'=>'arrows-move',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'7',
            'Description'=>'Picking',
            'icon'=>'box-arrow-up',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'7',
            'Description'=>'Added Value',
            'icon'=>'bag-plus',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'7',
            'Description'=>'Dispatching',
            'icon'=>'truck-flatbed',
            'route'=>'/Upcoming', 
        ]);

        DB::table('menus')->insert([
            'menuParent'=>'7',
            'Description'=>'Returns',
            'icon'=>'arrow-counterclockwise',
            'route'=>'/Upcoming', 
        ]);
//-------------
        DB::table('locaions')->insert([
            'code'=>'0',
            'name'=>'Local warehouse',
            'parent'=>'root',
            
        ]);
        

    }
}
