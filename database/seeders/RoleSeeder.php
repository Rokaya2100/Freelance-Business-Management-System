<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $client = Role::create(['name' => 'client']);
        $freelancer = Role::create(['name' => 'freelancer']);

         $admin->givePermissionTo([
            'create-role',
            'delete-role',
            'edit-role',
            'users-list',
            'contracts-list',
            'restore-contract',
            'projects-list',
            'reports-list',
            'comments-list',
            'export-report',
            'restore-report',
            'sections-list',
            'create-section',
            'edit-section',
            'delete-section',
            'create-user',
            'delete-user',
            'delete-contract',
            'delete-report',
        ]);

        $client->givePermissionTo([
            'create-project',
            'edit-project',
            'delete-project',
            'edit-offer-status',
            'show-contract',
            'track-project-progress',
            'review-project',
            'review-freelancer',
            'create-comment',
            'edit-comment',
            'delete-comment',
        ]);

        $freelancer->givePermissionTo([
            'create-offer',
            'edit-offer',
            'delete-offer',
            'edit-project-from-freelancer',
            'edit-contract',
            'create-portfolio',
            'edit-portfolio',
            'delete-portfolio',
            'add-project-to-portfolio',
            'delete-project-from-portfolio'
        ]);
    }
}
