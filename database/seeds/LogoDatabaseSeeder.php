<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logo')->truncate();
        $dataIntroduce = [
            'name' => 'Company Test',
            'image' => 'introduce',
            'created_at' => date('Y-m-d H:i:S'),
            'updated_at' => date('Y-m-d H:i:S'),
        ];
        DB::table('logo')->insert([$dataIntroduce]);
    }
}
