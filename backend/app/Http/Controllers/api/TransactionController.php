<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\Monthly_Budget;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Methods;
use App\Http\Requests\StoreTransactionsRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {      
        $user = Auth::user();
        $meseCorrente = now()->format('m-Y');
        $transactions = Transactions::with('Expense_Categories', 'paymentMethod')
            ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
            ->where('monthly__budgets.month_year', '=', $meseCorrente)
            ->select('transactions.*')
            ->paginate(10);

        $allMonths = Monthly_Budget::select('month_year')
        ->where('monthly__budgets.user_id', '=', $user['id'])
        ->get();

        if($transactions) {
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $transactions,
                'months' => $allMonths
            ]);
        }
        else {
            return response()->json([
                'code' => 404,
                'success' => false,
            ]);
        }
    }

    public function indexOld(Request $request)
    {      
        $user = Auth::user();
        $data = [
            'month' => $request->input('month')
        ];

        switch ($data['month']) {
            case 'Gennaio':
                $data['month'] = 1;
                break;
            case 'Febbraio':
                $data['month'] = 2;
                break;
            case 'Marzo':
                $data['month'] = 3;
                break;
            case 'Aprile':
                $data['month'] = 4;
                break;
            case 'Maggio':
                $data['month'] = 5;
                break;
            case 'Giugno':
                $data['month'] = 6;
                break;
            case 'Luglio':
                $data['month'] = 7;
                break;
            case 'Agosto':
                $data['month'] = 8;
                break;
            case 'Settembre':
                $data['month'] = 9;
                break;
            case 'Ottobre':
                $data['month'] = 10;
                break;
            case 'Novembre':
                $data['month'] = 11;
                break;
            case 'Dicembre':
                $data['month'] = 12;
                break;
        }
        

        $transactions = Transactions::with('Expense_Categories', 'paymentMethod')
            ->join('monthly__budgets', 'transactions.monthly_budget_id', '=', 'monthly__budgets.id')
            ->where('monthly__budgets.month_year', 'LIKE', '%' .  $data['month'] . '%')
            ->select('transactions.*')
            ->paginate(10);
        
            
        $allMonths = Monthly_Budget::select('month_year')
        ->where('monthly__budgets.user_id', '=', $user['id'])
        ->get();

        if($transactions) {
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $transactions,
                'months' => $allMonths
            ]);
        }
        else {
            return response()->json([
                'code' => 404,
                'success' => false,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionsRequest $request)
    {   
        $meseCorrente = now()->format('m-Y');
        $userId = Auth::id();
        $currentBudgetId = DB::table('monthly__budgets')
            ->where('month_year', '=', $meseCorrente)
            ->where('user_id', '=', $userId)
            ->first();

        $data = [
            'date' => $request->input('date'),
            'description' => $request->input('description'),
            'payment' => $request->input('payment'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
        ];

            
         Transactions::create([
            'date' => $data['date'],
           'description' => $data['description'],
           'amount' => $data['price'],
           'methods_id' => $data['payment'],
           'category_id' => $data['category'],
           'user_id' => $userId,
           'monthly_budget_id' =>  $currentBudgetId->id
        ]);
    
        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $data,
            'test' =>  $currentBudgetId
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transactions $transaction)
    {   
        $transaction->load('Expense_Categories', 'paymentMethod');
        return response()->json([
            'data' => $transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transactions $transaction)
    {
        $transaction->delete();
        return response()->json([
            'message' => 'Transazione eliminata con successo',
        ]);
    }
}
