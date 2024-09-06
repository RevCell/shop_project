<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/////////////////////////Guest only///////////////////////////////////
Route::get('/', function () {
    return view('welcome');
});
//CLIENT SIDE//
Route::middleware("guest")->group(function () {
    Route::prefix("client")->group(function () {

        //Register
        Route::get("/register/create",
            [\App\Http\Controllers\client\RegisterController::class, 'create'])
            ->name("register.create");

        Route::post("/register/store",
            [\App\Http\Controllers\client\RegisterController::class, 'store'])
            ->name("register.store");

        Route::get("/register/code_chk/{user}",
            [\App\Http\Controllers\client\RegisterController::class, 'code_create'])
            ->name("register.code_chk");

        Route::post("/register/code_verify/{user}",
            [\App\Http\Controllers\client\RegisterController::class, 'code_chk'])
            ->name("register.verify");

        //Login
        Route::get("/login/show",
            [\App\Http\Controllers\client\LoginController::class, 'show'])
            ->name("login");

        Route::post("/login/login",
            [\App\Http\Controllers\client\LoginController::class, 'login'])
            ->name("login.verify");

        Route::get("/login/recovery",
            [\App\Http\Controllers\client\LoginController::class, 'edit'])
            ->name("login.pass_recovery");

        Route::post("/login/password_recovery",
            [\App\Http\Controllers\client\LoginController::class, 'update'])
            ->name("login.recovery");
    }
    );

});
/////////////////////////Login only///////////////////////////////////
Route::middleware("auth")->group(function ()
{
    // ADMIN PANEL//
    Route::prefix("admin")->group(function () {
        //Dashboard
        Route::get("/dashboard",
            [\App\Http\Controllers\admin\dashboard::class, "dashboard"])
            ->name("admin_dashboard");

        //Category
        Route::get("/category/index",
            [\App\Http\Controllers\admin\CategoryController::class, "index"])
            ->name("category.index");

        Route::get("/category/create",
            [\App\Http\Controllers\admin\CategoryController::class, "create"])
            ->name("category.create");

        Route::post("/category/store",
            [\App\Http\Controllers\admin\CategoryController::class, "store"])
            ->name("category.store");

        Route::get("/category/edit/{category}",
            [\App\Http\Controllers\admin\CategoryController::class, "edit"])
            ->name("category.edit");

        Route::patch("/category/{category}",
            [\App\Http\Controllers\admin\CategoryController::class, "update"])
            ->name("category.update");

        Route::delete("/category/delete/{category}",
            [\App\Http\Controllers\admin\CategoryController::class, "destroy"])
            ->name("category.delete");

        //Brand
        Route::get("/brand/create",
            [\App\Http\Controllers\admin\BrandController::class, 'create'])
            ->name("brand.create");

        Route::post("/brand/store",
            [\App\Http\Controllers\admin\BrandController::class, 'store'])
            ->name("brand.store");

        Route::get("/brand/index",
            [\App\Http\Controllers\admin\BrandController::class, 'index'])
            ->name("brand.index");

        Route::get("/brand/edit/{brand}",
            [\App\Http\Controllers\admin\BrandController::class, 'edit'])
            ->name("brand.edit");

        Route::patch("/brand/update/{brand}",
            [\App\Http\Controllers\admin\BrandController::class, 'update'])
            ->name("brand.update");

        Route::delete("/brand/delete/{brand}",
            [\App\Http\Controllers\admin\BrandController::class, 'destroy'])
            ->name("brand.delete");

        //Product
        Route::get("/product/create",
            [\App\Http\Controllers\admin\ProductController::class, 'create'])
            ->name("product.create");

        Route::post("/product/store",
            [\App\Http\Controllers\admin\ProductController::class, 'store'])
            ->name("product.store");

        Route::get("/product/index",
            [\App\Http\Controllers\admin\ProductController::class, 'index'])
            ->name("product.index");

        Route::get("/product/edit/{product}",
            [\App\Http\Controllers\admin\ProductController::class, 'edit'])
            ->name("product.edit");

        Route::patch("/product/update/{product}",
            [\App\Http\Controllers\admin\ProductController::class, 'update'])
            ->name("product.update");

        Route::delete("/product/delete/{product}",
            [\App\Http\Controllers\admin\ProductController::class, 'destroy'])
            ->name("product.delete");

        //Discount
        Route::get("/discount/create/{product}",
            [\App\Http\Controllers\admin\DiscountController::class, 'create'])
            ->name("discount.create");

        Route::post("/discount/store/{product}",
            [\App\Http\Controllers\admin\DiscountController::class, 'store'])
            ->name("discount.store");

        Route::delete("/discount/delete/{discount}",
            [\App\Http\Controllers\admin\DiscountController::class, 'destroy'])
            ->name("discount.delete");

        //Gallery
        Route::get("/gallery/create/{product}",
            [\App\Http\Controllers\admin\ProductGalleryController::class, 'create'])
            ->name('gallery.create');

        Route::post("/gallery/store/{product}",
            [\App\Http\Controllers\admin\ProductGalleryController::class, 'store'])
            ->name("gallery.store");

        Route::delete("/gallery/delete/{product_gallery}/{product}",
            [\App\Http\Controllers\admin\ProductGalleryController::class, 'destroy'])
            ->name("gallery.delete");

        //Property_Group
        Route::get("/property_group/index",
            [\App\Http\Controllers\admin\PropertyGroupController::class, "index"])
            ->name("property_g.index");

        Route::get("/property_group/create",
            [\App\Http\Controllers\admin\PropertyGroupController::class, "create"])
            ->name("property_g.create");

        Route::post("/property_group/store",
            [\App\Http\Controllers\admin\PropertyGroupController::class, "store"])
            ->name("property_g.store");

        Route::get("/property_group/edit/{property_group}",
            [\App\Http\Controllers\admin\PropertyGroupController::class, "edit"])
            ->name("property_g.edit");

        Route::patch("/property_group/{property_group}",
            [\App\Http\Controllers\admin\PropertyGroupController::class, "update"])
            ->name("property_g.update");

        Route::delete("/property_group/delete/{property_group}",
            [\App\Http\Controllers\admin\PropertyGroupController::class, "destroy"])
            ->name("property_g.delete");

        //Property
        Route::get("/property/index",
            [\App\Http\Controllers\admin\PropertyController::class, "index"])
            ->name("property.index");

        Route::get("/property/create",
            [\App\Http\Controllers\admin\PropertyController::class, "create"])
            ->name("property.create");

        Route::post("/property/store",
            [\App\Http\Controllers\admin\PropertyController::class, "store"])
            ->name("property.store");

        Route::get("/property/edit/{property}",
            [\App\Http\Controllers\admin\PropertyController::class, "edit"])
            ->name("property.edit");

        Route::patch("/property/{property}",
            [\App\Http\Controllers\admin\PropertyController::class, "update"])
            ->name("property.update");

        Route::delete("/property/delete/{property}",
            [\App\Http\Controllers\admin\PropertyController::class, "destroy"])
            ->name("property.delete");

        //Product_Property
        Route::get("/product/{product}/property",
            [\App\Http\Controllers\admin\Product_Propertycontroller::class, "index"])
            ->name("product_property.index");

        Route::get("/product/{product}/property/create",
            [\App\Http\Controllers\admin\Product_Propertycontroller::class, "create"])
            ->name("product_property.create");

        Route::post("/product/{product}/property/store",
            [\App\Http\Controllers\admin\Product_Propertycontroller::class, "store"])
            ->name("product_property.store");

        //Comment -Admin
        Route::get("/product/{product}/comment/index",
            [\App\Http\Controllers\admin\CommentController::class, "index"])
            ->name("product.comment.index");

        Route::get("/product/{product}/{comment}/edit",
            [\App\Http\Controllers\admin\CommentController::class, "edit"])
            ->name("product.comment.edit");

        Route::patch("/product/{product}/{comment}/update",
            [\App\Http\Controllers\admin\CommentController::class, "update"])
            ->name("product.comment.update");

        Route::delete("/product/{comment}/delete",
            [\App\Http\Controllers\admin\CommentController::class, "destroy"])
            ->name("product.comment.delete");

        //Roles
        Route::get("/role/create",
            [\App\Http\Controllers\admin\RoleController::class, 'create'])
            ->name("role.create");

        Route::post("/role/store",
            [\App\Http\Controllers\admin\RoleController::class, 'store'])
            ->name("role.store");

        Route::get("/role/index",
            [\App\Http\Controllers\admin\RoleController::class, 'index'])
            ->name("role.index");

        Route::get("/role/edit/{role}",
            [\App\Http\Controllers\admin\RoleController::class, 'edit'])
            ->name("role.edit");

        Route::patch("/role/update/{role}",
            [\App\Http\Controllers\admin\RoleController::class, 'update'])
            ->name("role.update");

        Route::delete("/role/delete/{role}",
            [\App\Http\Controllers\admin\RoleController::class, 'destroy'])
            ->name("role.delete");

        //Users
        Route::get("/user/index",
            [\App\Http\Controllers\admin\UserController::class, 'index'])
            ->name("user.index");

        Route::get("/user/edit/{user}",
            [\App\Http\Controllers\admin\UserController::class, 'edit'])
            ->name("user.edit");

        Route::patch("/user/update/{user}",
            [\App\Http\Controllers\admin\UserController::class, 'update'])
            ->name("user.update");

        Route::delete("/user/delete/{user}",
            [\App\Http\Controllers\admin\UserController::class, 'destroy'])
            ->name("user.delete");
        //Profile
        Route::get("/profile/show",
            [\App\Http\Controllers\admin\ProfileController::class, 'show'])
            ->name("profile.show");

        Route::patch("/profile/update/{user}",
            [\App\Http\Controllers\admin\ProfileController::class, 'update'])
            ->name("profile.update");

        //Featured Category
        Route::get("/featured_cat/create",
            [\App\Http\Controllers\admin\FeaturedCatController::class, 'create'])
            ->name("featured_cat.create");

        Route::post("/featured_cat/store",
            [\App\Http\Controllers\admin\FeaturedCatController::class, 'store'])
            ->name("featured_cat.store");

    }
    );

    //CLIENT SIDE//

    //Comments -Client
    Route::post("/product/{product}/comment/store",
        [\App\Http\Controllers\client\CommentController::class, "store"])
        ->name("product.comment.store");
    //Like
    Route::post("/like/{product}",
        [\App\Http\Controllers\client\LikeController::class,"store"])
        ->name("like");

    Route::delete("/like/unlike/{product}",
        [\App\Http\Controllers\client\LikeController::class,"de_store"])
        ->name("unlike");

    Route::get("/wishlist/index/",
        [\App\Http\Controllers\client\LikeController::class,"index"])
        ->name("wishlist");

    //LogOut
    Route::delete("/register/logout/",
        [\App\Http\Controllers\client\RegisterController::class, 'logout'])
        ->name("register.logout");

    //Cart
    Route::post("/cart/store/{product}",
        [\App\Http\Controllers\client\cartcontroller::class,"store"])
        ->name("cart.store");

    Route::patch("/cart/update/{product}",
        [\App\Http\Controllers\client\cartcontroller::class,"update"])
        ->name("cart.update");

    Route::get("/cart/index/",
        [\App\Http\Controllers\client\cartcontroller::class,"index"])
        ->name("cart.index");

    Route::delete("/cart/delete/{product}",
        [\App\Http\Controllers\client\cartcontroller::class,"destroy"])
        ->name("cart.delete");

    //Check Out
    Route::get("/checkout/create",
    [\App\Http\Controllers\client\CheckoutController::class,'create'])
        ->name("checkout.create");

    Route::post("/checkout/store",
    [\App\Http\Controllers\client\CheckoutController::class,'store'])
        ->name("checkout.store");

    Route::get("/client/checkout/payment_report",
    [\App\Http\Controllers\client\CheckoutController::class,'payment_report']);

    Route::get("/checkout/show/{checkout}",
    [\App\Http\Controllers\client\CheckoutController::class,'show'])
        ->name("checkout.report");
}
);
/////////////////////////Neutral///////////////////////////////////
Route::prefix("client")->group(function () {
    Route::get("/home",
        [\App\Http\Controllers\client\home::class, 'homepage'])
        ->name("shop_home");

    Route::get("/product_detail/show/{pros}",
        [\App\Http\Controllers\client\Detailcontroller::class, 'show'])
        ->name("client.product.detail");

    Route::get("/category/index/{category}",
        [\App\Http\Controllers\client\CategoryController::class, 'index'])
        ->name("client.category.index");
});
