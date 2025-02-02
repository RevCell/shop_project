<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedCat extends Model
{
    use HasFactory;

    protected $guarded= [];

    public $incrementing = false;

    protected $primaryKey = 'category_id';

    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
