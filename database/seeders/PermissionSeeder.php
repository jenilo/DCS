<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superadmin =  Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $user =  Role::create(['name' => 'user']);

        //Users
        Permission::create(['name' => 'crud users for clinic']);
        //Clinics
        Permission::create(['name' => 'crud clinics']);
        //Permission::create(['name' => 'create clinic']);
        Permission::create(['name' => 'read clinic']);
        Permission::create(['name' => 'update clinic']);
        Permission::create(['name' => 'delete clinic']);

        
        $superadmin->givePermissionTo([
            'crud clinics',
        ]);

        $admin->givePermissionTo([
            'crud users for clinic',
            'read clinic',
            'update clinic',
            'delete clinic',
        ]);

        $user->givePermissionTo([
            'read clinic',
        ]);

        $users = User::all();

        foreach ($users as $user) {
            if($user->role_id != null)
                $user->assignRole($user->role_id);
        }
    }
}
