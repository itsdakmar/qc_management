<?php

use App\Responsibility;
use Illuminate\Database\Seeder;

class ResponsibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Responsibility::create([
            'name' => 'Econpile',
        ]);

        Responsibility::create([
            'name' => 'CSES',
        ]);

        Responsibility::create([
            'name' => 'YDI',
        ]);
    }
}
