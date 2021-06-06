<?php

use Illuminate\Database\Seeder;

class menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
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

//permision sample
DB::table('permissions')->insert([
    'permCode'=>'1',
    'Description'=>'Local',            
]);

DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'1',            
]);

DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'2',            
]);

DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'3',            
]);

DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'4',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'5',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'6',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'7',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'8',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'9',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'10',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'11',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'12',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'13',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'14',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'15',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'16',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'17',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'18',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'19',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'20',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'21',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'22',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'23',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'24',            
]);
DB::table('permission_details')->insert([
    'permCode'=>'1',
    'id'=>'25',            
]);



 
    }
}
