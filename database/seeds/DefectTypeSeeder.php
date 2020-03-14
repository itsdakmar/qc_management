<?php

use App\DefectType;
use Illuminate\Database\Seeder;

class DefectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DefectType::create([
            'name' => 'Cracks behaviour',
        ]);


        DefectType::create([
            'name' => 'Honeycomb',
        ]);

        DefectType::create([
            'name' => 'Bulging',
        ]);

        DefectType::create([
            'name' => 'Twisted',
        ]);

        DefectType::create([
            'name' => 'Chipping off',
        ]);

        DefectType::create([
            'name' => 'Steel bars exposed',
        ]);

        DefectType::create([
            'name' => 'Leftover concrete waste',
        ]);

        DefectType::create([
            'name' => 'Damage / Broken',
        ]);

        DefectType::create([
            'name' => 'Dimensional errors',
        ]);

        DefectType::create([
            'name' => 'Finishing errors',
        ]);

        DefectType::create([
            'name' => 'Shrinkage',
        ]);

        DefectType::create([
            'name' => 'Others',
        ]);


    }
}
