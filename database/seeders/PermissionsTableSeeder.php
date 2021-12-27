<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'category_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 19,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 20,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 21,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 22,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 23,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 25,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 26,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 27,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 28,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 30,
                'title' => 'category_create',
            ],
            [
                'id'    => 31,
                'title' => 'category_edit',
            ],
            [
                'id'    => 32,
                'title' => 'category_show',
            ],
            [
                'id'    => 33,
                'title' => 'category_delete',
            ],
            [
                'id'    => 34,
                'title' => 'category_access',
            ],
            [
                'id'    => 35,
                'title' => 'attribute_create',
            ],
            [
                'id'    => 36,
                'title' => 'attribute_edit',
            ],
            [
                'id'    => 37,
                'title' => 'attribute_show',
            ],
            [
                'id'    => 38,
                'title' => 'attribute_delete',
            ],
            [
                'id'    => 39,
                'title' => 'attribute_access',
            ],
            [
                'id'    => 40,
                'title' => 'attribute_value_create',
            ],
            [
                'id'    => 41,
                'title' => 'attribute_value_edit',
            ],
            [
                'id'    => 42,
                'title' => 'attribute_value_show',
            ],
            [
                'id'    => 43,
                'title' => 'attribute_value_delete',
            ],
            [
                'id'    => 44,
                'title' => 'attribute_value_access',
            ],
            [
                'id'    => 45,
                'title' => 'attribute_management_access',
            ],
            [
                'id'    => 46,
                'title' => 'color_create',
            ],
            [
                'id'    => 47,
                'title' => 'color_edit',
            ],
            [
                'id'    => 48,
                'title' => 'color_show',
            ],
            [
                'id'    => 49,
                'title' => 'color_delete',
            ],
            [
                'id'    => 50,
                'title' => 'color_access',
            ],
            [
                'id'    => 51,
                'title' => 'brand_create',
            ],
            [
                'id'    => 52,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 53,
                'title' => 'brand_show',
            ],
            [
                'id'    => 54,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 55,
                'title' => 'brand_access',
            ],
            [
                'id'    => 56,
                'title' => 'size_create',
            ],
            [
                'id'    => 57,
                'title' => 'size_edit',
            ],
            [
                'id'    => 58,
                'title' => 'size_show',
            ],
            [
                'id'    => 59,
                'title' => 'size_delete',
            ],
            [
                'id'    => 60,
                'title' => 'size_access',
            ],
            [
                'id'    => 61,
                'title' => 'product_create',
            ],
            [
                'id'    => 62,
                'title' => 'product_edit',
            ],
            [
                'id'    => 63,
                'title' => 'product_show',
            ],
            [
                'id'    => 64,
                'title' => 'product_delete',
            ],
            [
                'id'    => 65,
                'title' => 'product_access',
            ],
            [
                'id'    => 66,
                'title' => 'product_image_create',
            ],
            [
                'id'    => 67,
                'title' => 'product_image_edit',
            ],
            [
                'id'    => 68,
                'title' => 'product_image_show',
            ],
            [
                'id'    => 69,
                'title' => 'product_image_delete',
            ],
            [
                'id'    => 70,
                'title' => 'product_image_access',
            ],
            [
                'id'    => 71,
                'title' => 'product_variation_create',
            ],
            [
                'id'    => 72,
                'title' => 'product_variation_edit',
            ],
            [
                'id'    => 73,
                'title' => 'product_variation_show',
            ],
            [
                'id'    => 74,
                'title' => 'product_variation_delete',
            ],
            [
                'id'    => 75,
                'title' => 'product_variation_access',
            ],
            [
                'id'    => 76,
                'title' => 'product_attribute_create',
            ],
            [
                'id'    => 77,
                'title' => 'product_attribute_edit',
            ],
            [
                'id'    => 78,
                'title' => 'product_attribute_show',
            ],
            [
                'id'    => 79,
                'title' => 'product_attribute_delete',
            ],
            [
                'id'    => 80,
                'title' => 'product_attribute_access',
            ],
            [
                'id'    => 81,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 82,
                'title' => 'map_attribute_access',
            ],
            [
                'id'    => 83,
                'title' => 'map_attribute_create',
            ],
            [
                'id'    => 84,
                'title' => 'map_attribute_edit',
            ],
            [
                'id'    => 85,
                'title' => 'map_attribute_show',
            ],
            [
                'id'    => 86,
                'title' => 'map_attribute_delete',
            ],
            [
                'id'    => 87,
                'title' => 'coupon_create',
            ],
            [
                'id'    => 88,
                'title' => 'coupon_edit',
            ],
            [
                'id'    => 89,
                'title' => 'coupon_show',
            ],
            [
                'id'    => 90,
                'title' => 'coupon_delete',
            ],
            [
                'id'    => 91,
                'title' => 'coupon_access',
            ],
            [
                'id'    => 92,
                'title' => 'master_access',
            ],
            [
                'id'    => 93,
                'title' => 'slider_create',
            ],
            [
                'id'    => 94,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 95,
                'title' => 'slider_show',
            ],
            [
                'id'    => 96,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 97,
                'title' => 'slider_access',
            ],
            [
                'id'    => 98,
                'title' => 'social_profile_type_create',
            ],
            [
                'id'    => 99,
                'title' => 'social_profile_type_edit',
            ],
            [
                'id'    => 100,
                'title' => 'social_profile_type_show',
            ],
            [
                'id'    => 101,
                'title' => 'social_profile_type_delete',
            ],
            [
                'id'    => 102,
                'title' => 'social_profile_type_access',
            ],
            [
                'id'    => 103,
                'title' => 'user_social_profile_create',
            ],
            [
                'id'    => 104,
                'title' => 'user_social_profile_edit',
            ],
            [
                'id'    => 105,
                'title' => 'user_social_profile_show',
            ],
            [
                'id'    => 106,
                'title' => 'user_social_profile_delete',
            ],
            [
                'id'    => 107,
                'title' => 'user_social_profile_access',
            ],
            [
                'id'    => 108,
                'title' => 'store_create',
            ],
            [
                'id'    => 109,
                'title' => 'store_edit',
            ],
            [
                'id'    => 110,
                'title' => 'store_show',
            ],
            [
                'id'    => 111,
                'title' => 'store_delete',
            ],
            [
                'id'    => 112,
                'title' => 'store_access',
            ],
            [
                'id'    => 113,
                'title' => 'cms_page_create',
            ],
            [
                'id'    => 114,
                'title' => 'cms_page_edit',
            ],
            [
                'id'    => 115,
                'title' => 'cms_page_show',
            ],
            [
                'id'    => 116,
                'title' => 'cms_page_delete',
            ],
            [
                'id'    => 117,
                'title' => 'cms_page_access',
            ],
            [
                'id'    => 118,
                'title' => 'testimonial_create',
            ],
            [
                'id'    => 119,
                'title' => 'testimonial_edit',
            ],
            [
                'id'    => 120,
                'title' => 'testimonial_show',
            ],
            [
                'id'    => 121,
                'title' => 'testimonial_delete',
            ],
            [
                'id'    => 122,
                'title' => 'testimonial_access',
            ],
            [
                'id'    => 123,
                'title' => 'newsletter_create',
            ],
            [
                'id'    => 124,
                'title' => 'newsletter_edit',
            ],
            [
                'id'    => 125,
                'title' => 'newsletter_show',
            ],
            [
                'id'    => 126,
                'title' => 'newsletter_delete',
            ],
            [
                'id'    => 127,
                'title' => 'newsletter_access',
            ],
            [
                'id'    => 128,
                'title' => 'menu_create',
            ],
            [
                'id'    => 129,
                'title' => 'menu_edit',
            ],
            [
                'id'    => 130,
                'title' => 'menu_show',
            ],
            [
                'id'    => 131,
                'title' => 'menu_delete',
            ],
            [
                'id'    => 132,
                'title' => 'menu_access',
            ],
            [
                'id'    => 133,
                'title' => 'blog_create',
            ],
            [
                'id'    => 134,
                'title' => 'blog_edit',
            ],
            [
                'id'    => 135,
                'title' => 'blog_show',
            ],
            [
                'id'    => 136,
                'title' => 'blog_delete',
            ],
            [
                'id'    => 137,
                'title' => 'blog_access',
            ],
            [
                'id'    => 138,
                'title' => 'profile_password_edit',
            ],
            
        ];

        Permission::insert($permissions);
    }
}
