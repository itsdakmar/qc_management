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
        Role::create(['name' => 'main', 'description' => 'QAQC main contractor']);
        Role::create(['name' => 'main_sub', 'description' => 'Main contractor & Subcontractor']);
        Role::create(['name' => 'other', 'description' => 'Other Organization ']);


    }
}
