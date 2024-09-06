<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public static function findByTitle ($data)
    {
        return self::query()->whereTitle($data)->firstOrFail();
    }

    public function permissions_chk($permissions)
    {
        $role=Permission::query()->where("title",$permissions)
            ->firstOrFail();

        return $this->permissions()->where('id',$role->id)
            ->exists();
    }


}
