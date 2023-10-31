<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Monthly_Budget;
use App\Models\Transactions;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function budget() {
        $user = Auth::user();
        $meseCorrente = now()->format('m-Y');
        
        $monthIncome = Monthly_Budget::select('monthly_income')
        ->where('month_year', '=', $meseCorrente) 
        ->where('user_id', $user['id'])  
        ->first();

        $MoreExpenseransaction = DB::table('transactions')
        ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
        ->where('monthly__budgets.user_id', '=', $user['id'])
        ->where('monthly__budgets.month_year', '=', $meseCorrente)
        ->select('transactions.*')
        ->orderBy('amount', 'desc')
        ->first();
            
        $totalExpense = DB::table('transactions')
        ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
        ->where('monthly__budgets.user_id', '=', $user['id'])
        ->where('monthly__budgets.month_year', '=', $meseCorrente)
        ->select('transactions.*')
        ->sum('amount');    

        $remainingBudget = $monthIncome->monthly_income - $totalExpense;


        $totaleSpesePerCategoriaMeseCorrente = DB::table('transactions')
        ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
        ->where('monthly__budgets.month_year', '=', $meseCorrente)
        ->where('monthly__budgets.user_id', '=', $user['id'])
        ->select('transactions.category_id', DB::raw('SUM(transactions.amount) as totaleSpese'))
        ->groupBy('transactions.category_id')
        ->get();
    

        $percentualiSpesaPerCategoria = [];

        foreach ($totaleSpesePerCategoriaMeseCorrente as $categoria) {
            $percentuale = ($categoria->totaleSpese / $totalExpense) * 100;
            $percentualiSpesaPerCategoria[$categoria->category_id] = ceil($percentuale);
        }

        $categories = Categories::all();

        $allMonths = Monthly_Budget::select('month_year')
        ->where('monthly__budgets.user_id', '=', $user['id'])
        ->get();

        $allExpenseMonths = Monthly_Budget::select('total_expenses')
        ->where('monthly__budgets.user_id', '=', $user['id'])
        ->get();
      
        if($monthIncome) {
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => [
                    'datas' => $monthIncome,
                    'expense' => $MoreExpenseransaction,
                    'categories' => $categories,
                    'total' => $totalExpense,
                    'remaining' => $remainingBudget,
                    'calcs' => $percentualiSpesaPerCategoria,
                    'months' => $allMonths,
                    'expensePerMonth' => $allExpenseMonths
                ],
            ]);
        }
        else{
            return response()->json([
                'code' => 404,
                'success' => false,
            ]);
        }
        
    }
}
