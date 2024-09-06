<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\category;
use App\Models\FeaturedCat;
use App\Models\User;
use App\Policies\Brandpolicy;
use App\Policies\Categorypolicy;
use App\Policies\CommentPolicy;
use App\Policies\FeaturedCatpolicy;
use App\Policies\GalleryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PropertyGrouppolicy;
use App\Policies\Propertypolicy;
use App\Policies\Rolepolicy;
use App\Policies\Userpolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\Brand' => 'App\Policies\BrandPolicy',
         'App\Models\category' => 'App\Policies\CategoryPolicy',
         'App\Models\property_group' => 'App\Policies\propertyGroupPolicy',
         'App\Models\Property' => 'App\Policies\PropertyPolicy',
         'App\Models\Role' => 'App\Policies\RolePolicy',
         'App\Models\Comment' => 'App\Policies\CommentPolicy',
         'App\Models\FeaturedCat' => 'App\Policies\FeaturedCatPolicy',
         'App\Models\User' => 'App\Policies\Userpolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Illuminate\Support\Facades\View::share(
            'categories',category::query()->where("category_id",null)->get()
        );
        \Illuminate\Support\Facades\View::share(
            'brands',Brand::all()
        );

        //BRAND
        Gate::define("brand_create",[Brandpolicy::class,'create']);
        Gate::define("brand_update",[Brandpolicy::class,'update']);
        Gate::define("brand_read",[Brandpolicy::class,'viewAny']);
        Gate::define("brand_delete",[Brandpolicy::class,'delete']);
        //Category
        Gate::define("category_create",[Categorypolicy::class,'create']);
        Gate::define("category_update",[Categorypolicy::class,'update']);
        Gate::define("category_read",[Categorypolicy::class,'viewAny']);
        Gate::define("category_delete",[Categorypolicy::class,'delete']);
        //Property Group
        Gate::define("property_group_create",[PropertyGrouppolicy::class,'create']);
        Gate::define("property_group_update",[PropertyGrouppolicy::class,'update']);
        Gate::define("property_group_read",[PropertyGrouppolicy::class,'viewAny']);
        Gate::define("property_group_delete",[PropertyGrouppolicy::class,'delete']);
        //Property
        Gate::define("property_create",[Propertypolicy::class,'create']);
        Gate::define("property_update",[Propertypolicy::class,'update']);
        Gate::define("property_read",[Propertypolicy::class,'viewAny']);
        Gate::define("property_delete",[Propertypolicy::class,'delete']);
        //Role
        Gate::define("role_create",[Rolepolicy::class,'create']);
        Gate::define("role_update",[Rolepolicy::class,'update']);
        Gate::define("role_read",[Rolepolicy::class,'viewAny']);
        Gate::define("role_delete",[Rolepolicy::class,'delete']);
        //Members
        Gate::define("member_update",[Userpolicy::class,'update']);
        Gate::define("member_read",[Userpolicy::class,'viewAny']);
        Gate::define("member_delete",[Userpolicy::class,'delete']);
        //Admin Dashboard
        Gate::define("admin_dashboard_read",function (User $user)
        {
            return $user->role->permissions_chk("admin_dashboard_read");
        });
        //Gallery
        Gate::define("gallery_create",function (User $user)
        {
            return $user->role->permissions_chk("gallery_create");
        });
        Gate::define("gallery_delete",function (User $user)
        {
            return $user->role->permissions_chk("gallery_delete");
        });
        //Offer
        Gate::define("offer_create",function (User $user)
        {
            return $user->role->permissions_chk("offer_create");
        });
        Gate::define("offer_delete",function (User $user)
        {
            return $user->role->permissions_chk("offer_delete");
        });
        //Profile
        Gate::define("profile_read",function (User $user)
        {
            return $user->role->permissions_chk("profile_read");
        });
        Gate::define("profile_update",function (User $user)
        {
            return $user->role->permissions_chk("profile_update");
        });
        //Comment
        Gate::define("comment_create",[CommentPolicy::class,'create']);
        Gate::define("comment_read",[CommentPolicy::class,'viewAny']);
        Gate::define("comment_delete",[CommentPolicy::class,'delete']);
        //Product
        Gate::define("product_create",[ProductPolicy::class,'create']);
        Gate::define("product_update",[ProductPolicy::class,'update']);
        Gate::define("product_read",[ProductPolicy::class,'viewAny']);
        Gate::define("product_delete",[ProductPolicy::class,'delete']);
        //Featured Category
        Gate::define("featured_menu_create",[FeaturedCatpolicy::class,'create']);
        Gate::define("featured_menu_delete",[FeaturedCatpolicy::class,'delete']);


    }
}
