<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Laboratorist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratoristSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Laboratorist::create([
            'name' => 'lab.Ahmed Saad',
            'phone' => '01125756807',
            'email' => 'ahmed@cloudcare.com',
            'password' => '01125756807',

        ]);
    }
}
