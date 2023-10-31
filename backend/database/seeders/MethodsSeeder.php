<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Methods;

// facades
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
class MethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function(){
            Methods::truncate();
        });

        for ($i=0; $i < 5; $i++) {
            Methods::create([
                'name' => fake()->creditCardType(),
                'type'  => fake()->creditCardType(),
                'status' => fake()->boolean()
            ]);
        }
    }
}
