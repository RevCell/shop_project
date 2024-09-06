<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::query()->insert([
            //Category
            [
                'title'=>'category_create',
                'description'=>'ایجاد دسته بندی',
            ],

            [
                'title'=>'category_read',
                'description'=>'مشاهده دسته بندی',
            ],
            [
                'title'=>'category_update',
                'description'=>'ویرایش دسته بندی',
            ],
            [
                'title'=>'category_delete',
                'description'=>'حذف دسته بندی',
            ],

            //Brand
            [
                'title'=>'brand_create',
                'description'=>'ایجاد برند',
            ],

            [
                'title'=>'brand_read',
                'description'=>'مشاهده برند',
            ],
            [
                'title'=>'brand_update',
                'description'=>'ویرایش برند',
            ],
            [
                'title'=>'brand_delete',
                'description'=>'حذف برند',
            ],

            //Product
            [
                'title'=>'product_create',
                'description'=>'ایجاد محصولات',
            ],

            [
                'title'=>'product_read',
                'description'=>'مشاهده محصولات',
            ],
            [
                'title'=>'product_update',
                'description'=>'ویرایش محصولات',
            ],
            [
                'title'=>'product_delete',
                'description'=>'حذف محصولات',
            ],

            //Gallery
            [
                'title'=>'gallery_create',
                'description'=>'ایجاد گالری',
            ],
            [
                'title'=>'gallery_delete',
                'description'=>'حذف گالری',
            ],

            //Product_Property
            [
                'title'=>'product_property_update',
                'description'=>'ویرایش ویژگی محصولات',
            ],

            [
                'title'=>'product_property_read',
                'description'=>'مشاهده ویژگی محصولات',
            ],

            //Comment
            [
                'title'=>'comment_read',
                'description'=>'مشاهده دیدگاه',
            ],
            [
                'title'=>'comment_delete',
                'description'=>'حذف دیدگاه',
            ],

            [
                'title'=>'comment_create',
                'description'=>'ایجاد دیدگاه',
            ],

            //Property Group
            [
                'title'=>'property_group_create',
                'description'=>'ایجاد گروه مشخصات',
            ],

            [
                'title'=>'property_group_read',
                'description'=>'مشاهده گروه مشخصات',
            ],
            [
                'title'=>'property_group_update',
                'description'=>'ویرایش گروه مشخصات',
            ],
            [
                'title'=>'property_group_delete',
                'description'=>'حذف گروه مشخصات',
            ],
            //Property
            [
                'title'=>'property_create',
                'description'=>'ایجاد مشخصات',
            ],

            [
                'title'=>'property_read',
                'description'=>'مشاهده مشخصات',
            ],
            [
                'title'=>'property_update',
                'description'=>'ویرایش مشخصات',
            ],
            [
                'title'=>'property_delete',
                'description'=>'حذف مشخصات',
            ],

            //Roles
            [
                'title'=>'role_create',
                'description'=>'ایجاد نقش',
            ],

            [
                'title'=>'role_read',
                'description'=>'مشاهده نقش',
            ],
            [
                'title'=>'role_update',
                'description'=>'ویرایش نقش',
            ],
            [
                'title'=>'role_delete',
                'description'=>'حذف نقش',
            ],

            //Admin Dashboard
            [
                'title'=>'admin_dashboard_read',
                'description'=>'مشاهده پنل ادمین',
            ],

            //Offer
            [
                'title'=>'offer_create',
                'description'=>'ایجاد تخفیف',
            ],

            [
                'title'=>'offer_read',
                'description'=>'مشاهده تخفیف',
            ],
            [
                'title'=>'offer_delete',
                'description'=>'حذف تخفیف',
            ],

            //User Profile
            [
                'title'=>'profile_read',
                'description'=>'مشاهده حساب کاربری',
            ],
            [
                'title'=>'profile_update',
                'description'=>'ویرایش حساب کاربری',
            ],
            //Member Management
            [
                'title'=>'member_read',
                'description'=>'مشاهده اعضا',
            ],
            [
                'title'=>'member_update',
                'description'=>'ویرایش اعضا',
            ],
            [
                'title'=>'member_delete',
                'description'=>'حذف اعضا',
            ],
            //Likes
            [
                'title'=>'like_create',
                'description'=>'ایجاد لایک',
            ],

            [
                'title'=>'like_read',
                'description'=>'مشاهده لایک',
            ],
            [
                'title'=>'like_update',
                'description'=>'ویرایش لایک',
            ],
            [
                'title'=>'like_delete',
                'description'=>'حذف لایک',
            ],
            //Featured Category
            [
                'title'=>'featured_menu_create',
                'description'=>'ایجاد دسته بندی ویژه',
            ],
            [
                'title'=>'featured_menu_create',
                'description'=>'حذف دسته بندی ویژه',
            ],
        ]);
    }
}


