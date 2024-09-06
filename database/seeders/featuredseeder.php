<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\FeaturedCat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class featuredseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        category::query()->create([
            'id'=>'15',
            'title'=>"test1",
            'category_id'=>null
        ]);

        FeaturedCat::query()->create(
            [
                'category_id'=>'15'
            ]
        );
    }
}
