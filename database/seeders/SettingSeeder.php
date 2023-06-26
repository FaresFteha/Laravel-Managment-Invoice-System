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
            ['key' => 'app_name', 'value' => 'PyInvoice'],
            ['key' => 'company_name', 'value' => 'Company name'],
            ['key' => 'email', 'value' => 'faresfteha21@gmail.com'],
            ['key' => 'phone', 'value' => '+972597107791'],
            ['key' => 'address', 'value' => 'Palestine - Gaza'],
            ['key' => 'postal_code', 'value' => '+954'],
            ['key' => 'photo', 'value' => 'logo.png'],
        ];
        DB::table('settings')->insert($data);
    }
}
