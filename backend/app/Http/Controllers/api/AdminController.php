<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Monthly_Budget;
use App\Models\Transactions;
use App\Models\Categories;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private function processBudget($user, $meseCorrente, $conditionMonth)
    {
        $monthIncome = Monthly_Budget::select('monthly_income')
            ->where('month_year', $conditionMonth, $meseCorrente)
            ->where('user_id', $user['id'])
            ->first();

        $MoreExpenseransaction = DB::table('transactions')
            ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
            ->where('monthly__budgets.user_id', $user['id'])
            ->where('monthly__budgets.month_year', $conditionMonth, $meseCorrente)
            ->select('transactions.*')
            ->orderBy('amount', 'desc')
            ->first();

        $totalExpense = DB::table('transactions')
            ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
            ->where('monthly__budgets.user_id', $user['id'])
            ->where('monthly__budgets.month_year', $conditionMonth, $meseCorrente)
            ->select('transactions.*')
            ->sum('amount');

        $remainingBudget = $monthIncome->monthly_income - $totalExpense;

        $totaleSpesePerCategoriaMeseCorrente = DB::table('transactions')
            ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
            ->where('monthly__budgets.month_year', $conditionMonth, $meseCorrente)
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

        $totalExpenses = DB::table('transactions')
            ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
            ->where('monthly__budgets.month_year', $conditionMonth, $meseCorrente)
            ->where('monthly__budgets.user_id', '=', $user['id'])
            ->sum('amount');

        DB::table('monthly__budgets')
            ->where('user_id', $user['id'])
            ->where('month_year', $conditionMonth, $meseCorrente)
            ->update(['total_expenses' => $totalExpenses]);

        $allExpenseMonths = Monthly_Budget::select('total_expenses')
            ->where('monthly__budgets.user_id', '=', $user['id'])
            ->get();

        $totalExpenseEachDay = DB::table('transactions')
            ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
            ->where('monthly__budgets.user_id', '=', $user['id'])
            ->where('monthly__budgets.month_year', $conditionMonth, $meseCorrente)
            ->select('transactions.date', DB::raw('SUM(transactions.amount) as total_amount'))
            ->groupBy('transactions.date')
            ->get();

        return [
            'datas' => $monthIncome,
            'expense' => $MoreExpenseransaction,
            'categories' => $categories,
            'total' => $totalExpense,
            'remaining' => $remainingBudget,
            'calcs' => $percentualiSpesaPerCategoria,
            'months' => $allMonths,
            'expensePerMonth' => $allExpenseMonths,
            'eachday' => $totalExpenseEachDay
        ];
    }

    public function budget()
    {
        $user = Auth::user();
        $meseCorrente = now()->format('m-Y');
        $conditionMonth = '=';
        
        $result = $this->processBudget($user, $meseCorrente, $conditionMonth);

        return $this->getResponse($result);
    }

    public function oldBudget(Request $request)
    {
        $user = Auth::user();
        $data = [
            'month' => $request->input('month')
        ];
        $mesi_mapping = array(
            'gennaio' => 'January',
            'febbraio' => 'February',
            'marzo' => 'March',
            'aprile' => 'April',
            'maggio' => 'May',
            'giugno' => 'June',
            'luglio' => 'July',
            'agosto' => 'August',
            'settembre' => 'September',
            'ottobre' => 'October',
            'novembre' => 'November',
            'dicembre' => 'December',
        );
        $stringMonth = $data['month'];
        $englishName = $mesi_mapping[strtolower($stringMonth)];
        $currentYear = date('Y'); 
        $parse = date_parse($englishName);
        $monthNumber = $parse['month'];
        $formattedDate = $monthNumber . "-" . $currentYear;
        $conditionMonth = '=';
        
        $result = $this->processBudget($user, $formattedDate, $conditionMonth);

        return $this->getResponse($result);
    }

    private function getResponse($data)
    {
        if ($data['datas']) {
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'code' => 404,
                'success' => false,
            ]);
        }
    }
}
