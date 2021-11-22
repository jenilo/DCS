<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Enums\UserType;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Super Admin";
        //$user->username = "superadminusername";
        $user->email = "admin@admin.com";
        $user->password = Hash::make("secret");
        //$user->phone = "0000000000";
        $user->role_id = UserType::SuperAdmin;
        $user->save();

        $user = new User();
        $user->name = "Admin";
        //$user->username = "adminusername";
        $user->email = "admin@mail.com";
        $user->password = Hash::make("secret");
        //$user->phone = "0000000000";
        $user->role_id = UserType::Admin;
        $user->token = "2y10tzvy8Qa/w7.nwKSzh4/6r.XtdArHBClAmDOAEEw7GXDZqVnpY4o4.";
        $user->clinic_id = 1;
        $user->save();

        $user = new User();
        $user->name = "Client";
        //$user->username = "username";
        $user->email = "user@mail.com";
        $user->password = Hash::make("secret");
        //$user->phone = "0000000000";
        $user->role_id = UserType::User;
        $user->token = "2y10tzvy8Qa/w7.nwKSzh4/6r.XtdArHBClAmDOAEEw7GXDZqVnpY4o4.";
        $user->clinic_id = 1;
        $user->save();
    }
}
