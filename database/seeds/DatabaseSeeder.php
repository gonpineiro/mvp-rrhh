<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersSeeder::class);
      $this->call(RolesSeeder::class);
      $this->call(PermissionsSeeder::class);
      $this->call(PermissionRoleSeeder::class);

    }
}
