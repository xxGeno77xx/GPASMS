<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RolesClass;
use App\Enums\PermissionsClass;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
      
        // ===========Permissions creation======================
    
            $permissions = PermissionsClass::toValues();
    
            foreach ($permissions as $key => $name) {
                Permission::firstOrCreate([
                    'name' => $name,
                ]);
            }

    // ===========Roles creation======================
            $role = Role::firstOrCreate([
                'name' => RolesClass::SuperAdmin()->value,
                'guard_name' => 'web',
            ]);
    
        
            $role->syncPermissions($permissions);
    
            $superAdmin = User::firstOrCreate([
                'email' => RolesClass::SuperAdmin()->value.'@gmail.com', 
                'username' => RolesClass::SuperAdmin()->value,
                'password' => Hash::make('password'),
                'name' => RolesClass::SuperAdmin()->value,
    
            ]);
    
            $superAdmin->syncRoles(RolesClass::SuperAdmin()->value);
    
        }
}
