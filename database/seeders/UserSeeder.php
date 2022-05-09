<?php

namespace Database\Seeders;

use App\Models\User;
use App\Entities\Admin\Product;
use Illuminate\Database\Seeder;
use App\Entities\Admin\Category;
use App\Entities\Admin\SubCategory;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder{

    public function run()
    {
        $user = User::updateOrCreate([
            'email'=>'admin@admin.com',
        ],[
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>'12345678',
            'type'=>1,

        ]);

        $role = Role::where('name','admin')->first();
        $user->assignRole($role);

        $category = ['ملابس'];
        foreach($category as $item){
            Category::updateOrCreate(['name'=>"{$item}",],['name'=>"{$item}",]);
        }
        $array=Category::pluck('id')->toArray();
        $sub_category = ['جاكت','بناطيل','تيشرتات','قمصان'];
        foreach($sub_category as $item){
            SubCategory::updateOrCreate(['name'=>"{$item}",],['name'=>"{$item}",'category_id'=> $array[array_rand($array)]]);
        }

        $array=SubCategory::pluck('id')->toArray();
        for ($item=0; $item <20 ; $item++) {
            $price =rand(100,600);
            $amount =rand(10,60);
            $product = [
                'name'=> ' قميص رياضي ',
                'price'=>$price,
                'real_price'=>$price,
                'amount'=>$amount,
                'description'=>'اسود - قميص رياضي ' . ' '. $item,
                'sub_category_id'=> $array[array_rand($array)]
        ];
        Product::create($product);

    }

    }
}
