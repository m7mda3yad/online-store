<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{

    public function run()
    {

        $user = User::firstOrCreate([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('12345678'),
            'photo'=>'admin_photo',
        ]);
        $role = Role::where('name','admin')->first();
        $user->assignRole($role);
    }
}
