<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Admin']);
        $user = Role::create(['name' => 'User']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-produit',
            'edit-produit',
            'delete-produit',
            'create-clients',
            'edit-clients',
            'delete-clients',
            'delete-commandes',
            'edit-commandes',
            'create-commandes',
            'create-categories',
            'delete-categories',
            'view-dashbord'
        ]);

        $user->givePermissionTo([
            'create-produit',
            'edit-produit',
            'delete-produit',
            'create-clients',
            'edit-clients',
            'delete-clients',
            'delete-commandes',
            'edit-commandes',
            'create-commandes',
            'create-categories',
            'delete-categories',
        ]);
    }
}
