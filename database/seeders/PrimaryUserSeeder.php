<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrimaryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::query()->create(
            [
              'name'=>"Admin",
              'email'=>"drk.vala@gmail.com",
              'password'=>bcrypt(123456),
              'role_id'=>Role::query()->where("title",'Super_Admin')->first()->id,
            ]
        );
    }
}
