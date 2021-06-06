<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'View Article',
            'slug' => 'view-article'
        ]);

        Permission::create([
            'name' => 'Create Article',
            'slug' => 'create-article'
        ]);

        Permission::create([
            'name' => 'Edit Article',
            'slug' => 'edit-article'
        ]);

        Permission::create([
            'name' => 'Update Article',
            'slug' => 'update-article'
        ]);

        Permission::create([
            'name' => 'Delete Article',
            'slug' => 'delete-article'
        ]);

        Permission::create([
            'name' => 'Publish Article',
            'slug' => 'publish-article'
        ]);

        Permission::create([
            'name' => 'Publish Comment',
            'slug' => 'public-comment'
        ]);

        Permission::create([
            'name' => 'Give Role',
            'slug' => 'give-role'
        ]);

        $super_admin = Role::where('name', 'Super Admin')->first();
        $super_admin->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8]);

        $writer = Role::where('name', 'Writer')->first();
        $writer->permissions()->attach([1, 2, 3, 4]);

        $publisher = Role::where('name', 'Publisher')->first();
        $publisher->permissions()->attach([1, 6, 7]);


    }
}
