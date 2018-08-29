<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Settings
        DB::table('settings')->truncate();

        $dataList = [
            '1' => ['introduce'],
            '2' => ['phone','address','email'],
            '3' => ['facebook','twitter','google','instagram']
        ];

        foreach ($dataList as $key => $type) {
            foreach ($type as $data) {
                DB::table('settings')->insert([
                    'type' => $key,
                    'name' => $data,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

        }

    }
}
