<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ProductsMenu;

class ProductsMenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Settings
        DB::table('products_menu')->truncate();
        DB::table('products_menu_translate')->truncate();
        $faker = Faker\Factory::create();
        factory(ProductsMenu::class, 15)->create()->each(function ($menu) use ($faker) {
            $nameVi = 'Menu test số ' . $menu->id;
            $slugVi = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nameVi)));
            $dataVn = [
                'products_menu_id' => $menu->id,
                'locale' => 'vi',
                'name' => $nameVi,
                'slug' => $slugVi,
                'description' => $faker->realText(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('products_menu_translate')->insert($dataVn);

            $nameEn = 'Menu test number ' . $menu->id;
            $slugEn = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nameEn)));
            $dataEn = [
                'products_menu_id' => $menu->id,
                'locale' => 'en',
                'name' => $nameEn,
                'slug' => $slugEn,
                'description' => $faker->realText(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('products_menu_translate')->insert($dataEn);
        });
    }
}
