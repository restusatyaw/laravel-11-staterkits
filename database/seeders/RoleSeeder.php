<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'id' => Str::uuid(),
                'name' => 'Petugas'
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Customer'
            ]
        ]);
    }
}
