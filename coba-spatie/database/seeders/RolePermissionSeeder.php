<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // membuat kategori per permission
        $permissions = [
            'users' => ['add-user', 'edit-user', 'delete-user', 'view-user'], // untuk edit user
            'projects' => ['add-projects', 'edit-projects', 'delete-projects', 'view-projects'], // untuk edit projects
            'tasks' => ['add-task', 'edit-task', 'delete-task', 'view-task'], // untuk edit tasks
            'team' => ['assign-person', 'delete-person', 'view-team'], // untuk assign team
        ];

        // Create all permissions
        foreach ($permissions as $category => $actions) {
            foreach ($actions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }

        // Berikan role dengan permissions spesifik
        $rolesWithPermissions = [
            'Administrator' => array_merge(
                $permissions['users'],
                $permissions['projects'],
                $permissions['tasks'],
                $permissions['team']
            ),
            'Project-director' => [
                'add-projects',
                'view-projects',
                'view-task',
                'view-team',
                'assign-person',
                'delete-person'
            ],
            'Project-leader' => array_merge(
                $permissions['projects'],
                $permissions['tasks'],
                $permissions['team']
            ),
            'Staff' => [
                'view-projects',
                'view-task',
            ]
        ];

        // Create roles and assign permissions
        foreach ($rolesWithPermissions as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            if (!empty($rolePermissions)) {
                $role->givePermissionTo($rolePermissions);
            }
        }
    }
}
