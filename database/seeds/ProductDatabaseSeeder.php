<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Products;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Settings
        DB::table('products')->truncate();
        DB::table('products_translate')->truncate();
        DB::table('products_image')->truncate();
        $faker = Faker\Factory::create();
        factory(Products::class, 50)->create()->each(function ($product) use ($faker) {
            $nameVi = $faker->realText($maxNbChars = 100, $indexSize = 1);
            $slugVi = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nameVi)));
            $dataVn = [
                'products_id' => $product->id,
                'price' => $faker->numberBetween(100, 1000),
                'locale' => 'vi',
                'name' => $nameVi,
                'slug' => $slugVi,
                'description' => $faker->realText(),
                'content' => $faker->realText(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('products_translate')->insert($dataVn);

            $nameEn = $faker->realText($maxNbChars = 100, $indexSize = 1);
            $slugEn = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nameEn)));
            $dataEn = [
                'products_id' => $product->id,
                'price' => $faker->numberBetween(100, 1000),
                'locale' => 'en',
                'name' => $nameEn,
                'slug' => $slugEn,
                'description' => $faker->realText(),
                'content' => $faker->realText(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('products_translate')->insert($dataEn);

            $dataImage = [
                'products_id' => $product->id,
                'alt' => $faker->realText($maxNbChars = 50, $indexSize = 1),
                'name' => $faker->imageUrl($width = 640, $height = 480),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('products_image')->insert($dataImage);
        });
    }
}
