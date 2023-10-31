<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Monthly_Budget;

// facades
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class MonthlyBudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function(){
            Monthly_Budget::truncate();
        });

        for ($i=0; $i < 1; $i++) {
            $monthlyIncome = fake()->randomFloat(2, 1000, 2000);
            $totalExpenses = fake()->randomFloat(2, 400, 800);
            $balance = $monthlyIncome - $totalExpenses;
            Monthly_Budget::create([
                'month_year' => fake()->date('Y-m'),
                'monthly_income'  =>  $monthlyIncome,
                'total_expenses' =>  $totalExpenses,
                'balance' =>   $balance,
                'notes' => null,
                'user_id' => 1
            ]);
        }
    }
}
