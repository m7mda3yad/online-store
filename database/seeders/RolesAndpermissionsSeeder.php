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
            'view all user' ,  'add user' , 'update user' ,   'delete user' , 'suspend user',
            'view all university' ,  'add university' , 'update university' ,   'delete university' , 'suspend university',
            'view all faculty' ,  'add faculty' , 'update faculty' ,   'delete faculty' , 'suspend faculty',
            'view all course' ,  'add course' , 'update course' ,   'delete course' , 'suspend course',
            'view all subject' ,  'add subject' , 'update subject' ,   'delete subject' , 'suspend subject',
            'view all instructor' ,  'add instructor' , 'update instructor' ,   'delete instructor' , 'suspend instructor',
            'view all student' ,  'add student' , 'update student' ,   'delete student' , 'suspend student',
        ];

        foreach($permissions as $permission)

            Permission::firstOrCreate(['name'=>$permission]);

        Permission::whereNotIn('name',$permissions)->delete();

        $role = Role::firstOrCreate(['name' => 'admin']);

        $role->givePermissionTo(Permission::all());

    }
}
