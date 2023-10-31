<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transactions;
use App\Models\User;
use App\Models\Methods;
// facades
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;


class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function(){
            Transactions::truncate();
        });

        $user = User::where('email', 'stefano1314@hotmail.it')->first();
        $paymentMethod = Methods::inRandomOrder()->first();

        for ($i=0; $i < 30; $i++) {
            Transactions::create([
                'date' => now()->setDay(random_int(1, 30))->format('Y-m-d'),
                'description'  => fake()->word(),
                'amount' => fake()->randomFloat(2, 1, 40),
                'user_id' => $user->id,
                'methods_id' => rand(1, 5),
                'category_id' => rand(1, 9),
                'monthly_budget_id' => 1
            ]);
        }
    }
}
