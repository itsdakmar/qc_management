/<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'main']);
        Role::create(['name' => 'main_sub']);
        Role::create(['name' => 'other']);
    }
}
