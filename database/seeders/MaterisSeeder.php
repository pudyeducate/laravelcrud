<?php

namespace Database\Seeders;

use App\Models\MateriModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MateriModel::factory(10)->create();
    }
}
