<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
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
            'permCode'=>'1'
        ]);

        DB::table('users')->insert([
            'name' => 'Abi Tolentino',
            'email' => 'abitolentino@gmail.com',
            'password' => Hash::make('abitolentino'),
            'permCode'=>'1'
        ]);

         

    }
}
