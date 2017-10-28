<?php

use Illuminate\Database\Seeder;

class DosensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $karyawans = factory(App\Dosen::class,20)->create();
    }
}
