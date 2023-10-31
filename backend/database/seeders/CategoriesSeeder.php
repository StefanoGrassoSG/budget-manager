<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

// facades
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function(){
            Categories::truncate();
        });

        for ($i=0; $i < 10; $i++) {
            Categories::create([
                'name' => fake()->word(),
                'color'  => fake()->safeColorName(),
                'limit' => fake()->randomFloat(2, 1, 900),
                'total' => fake()->randomFloat(2, 1, 900)
            ]);
        }
    }
}
