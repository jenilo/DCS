<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\UserType;

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
        //appointment
        Permission::create(['name' => 'create appointment']);
        Permission::create(['name' => 'read appointment']);
        Permission::create(['name' => 'update appointment']);
        Permission::create(['name' => 'delete appointment']);
        //patient
        Permission::create(['name' => 'create patient']);
        Permission::create(['name' => 'read patient']);
        Permission::create(['name' => 'update patient']);
        Permission::create(['name' => 'delete patient']);
        
        $superadmin->givePermissionTo([
            'crud clinics',
        ]);

        $admin->givePermissionTo([
            'crud users for clinic',
            'read clinic',
            'update clinic',
            'delete clinic',
            'create appointment',
            'read appointment',
            'update appointment',
            'delete appointment',
            'create patient',
            'read patient',
            'update patient',
            'delete patient',
        ]);

        $user->givePermissionTo([
            'read clinic',
        ]);

        $users = User::all();

        foreach ($users as $u) {
            if($u->role_id != null)
                $u->assignRole($u->role_id);
            /*if($u->role_id != UserType::SuperAdmin)
                $u->assignRole($superadmin);  
            elseif($u->role_id != UserType::Admin)
                $u->assignRole($admin);
            elseif($u->role_id != UserType::User)
                $u->assignRole($user);*/
        }
    }
}
