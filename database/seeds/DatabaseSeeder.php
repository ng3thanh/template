<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SentinelDatabaseSeeder::class);
         $this->call(FooterDatabaseSeeder::class);
         $this->call(IntroduceDatabaseSeeder::class);
         $this->call(LogoDatabaseSeeder::class);
    }
}
