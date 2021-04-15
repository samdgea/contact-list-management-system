<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $roleAdmin = Role::create(['name' => 'Administrator']);
        $roleAgent = Role::create(['name' => 'Agent']);

        $p1 = Permission::create(['name' => 'Manage Users']);
        $p1 = Permission::create(['name' => 'Manage Customers']);
        $p1 = Permission::create(['name' => 'Assign Agent']);
        $p1 = Permission::create(['name' => 'Followup Customer']);

        $roleAdmin->givePermissionTo('Manage Users');
        $roleAdmin->givePermissionTo('Manage Customers');
        $roleAdmin->givePermissionTo('Assign Agent');
        $roleAdmin->givePermissionTo('Followup Customer');

        $roleAgent->givePermissionTo('Followup Customer');



        $adminUser = User::create([
            'name' => 'Administrator',
            'email' => 'admin@abdilah.id',
            'password' => \Hash::make('password')
        ]);
        $adminUser->assignRole($roleAdmin);

        $agentUser1 = User::create([
            'name' => 'Agent 1',
            'email' => 'agent.1@abdilah.id',
            'password' => \Hash::make('password')
        ]);
        $agentUser2 = User::create([
            'name' => 'Agent 2',
            'email' => 'agent.2@abdilah.id',
            'password' => \Hash::make('password')
        ]);
        $agentUser1->assignRole($roleAgent);
        $agentUser2->assignRole($roleAgent);
    }
}
