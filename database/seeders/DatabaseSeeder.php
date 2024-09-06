<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(PermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PrimaryUserSeeder::class);
        $this->call(SimpleUserSeeder::class);
        $this->call(featuredseeder::class);

    }
}
