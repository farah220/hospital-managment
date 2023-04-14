<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::create([
            'name' => 'farah',
            'phone' => '01125756807',
            'email' => 'farah-doctor@example.com',
            'password' => '01125756807',
            'department_id' => 1,
            'description' => 'this is farah desc',
            'price' => 200,
        ]);
    }
}
