<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->delete();

        $data = [
            'app_name' => 'PyInvoice',
            'company_name' => 'Company name',
            'email' => 'company_name@gmail.com',
            'phone' => '+972597107791',
            'address' => 'Palestine - Gaza',
            'postal_code' => '+954',
            'photo' => 'logo.png',
        ];
        DB::table('settings')->insert($data);
    }
}
