<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission ;

class RolesAndpermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'view all users','view all categories','view all sub_categories','view site data'
        ];

        //create all permissions
        foreach($permissions as $permission)
        {
            Permission::firstOrCreate(['name'=>$permission]);
        }
                //delete old anthor permission if not in array
            Permission::whereNotIn('name',$permissions)->delete();
            $role = Role::firstOrCreate(['name' => 'admin']);
                // admin role and permission
            $role = Role::firstOrCreate(['name' => 'admin']);
            Permission::firstOrCreate(['name'=>'admin']);
            $role->givePermissionTo('admin');

    }
}
