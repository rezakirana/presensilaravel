<?php

use Illuminate\Database\Seeder;
use App\Model\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create([
            'semester' => 'ganjil',
            'status' => 0
        ]);
        Semester::create([
            'semester' => 'genap',
            'status' => 1
        ]);
    }
}
