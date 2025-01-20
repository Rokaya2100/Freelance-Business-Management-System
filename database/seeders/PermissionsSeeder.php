<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
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
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
