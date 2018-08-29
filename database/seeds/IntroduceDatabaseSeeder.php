<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntroduceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('introduces')->truncate();
        $dataIntroduce = [
            'image' => 'introduce',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        DB::table('introduces')->insert([$dataIntroduce]);

        $dataTranslate = [
            ['introduce_id' => 1, 'locale' => 'en', 'name' => 'Test en', 'content' => 'Test en'],
            ['introduce_id' => 1, 'locale' => 'vi', 'name' => 'Test vi', 'content' => 'Test vi'],
        ];
        foreach ($dataTranslate as $value) {
            DB::table('introduces_translate')->insert([$value]);
        }

    }
}
