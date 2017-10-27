<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'superadmin',
                'username' => 'superadmin',
                'password' => bcrypt('secret'),
                'npk' => '000000',
                'role' => 1,
            ],
            [
                'name' => 'Duladi',
                'username' => 'duladi',
                'password' => bcrypt('secret'),
                'npk' => '202018',
                'role' => 2,
            ]
        ]);
    }
}
