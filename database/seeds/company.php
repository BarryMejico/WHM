<?php

use Illuminate\Database\Seeder;

class company extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
