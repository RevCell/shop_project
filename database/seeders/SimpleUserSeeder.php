<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SimpleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $simple_user=Role::query()->create(
            [
                'title'=>"simple_user"
            ]
        );

        $permissions=Permission::query()
            ->whereIn('title',
                [
                    'like_create',
                    'like_read',
                    'like_update',
                    'like_delete',
                    'profile_read',
                    'profile_update',
                    'admin_dashboard_read',
                    'comment_read',
                    'comment_create',
                ]
            )->get();

        $simple_user->permissions()->attach($permissions);
    }
}
