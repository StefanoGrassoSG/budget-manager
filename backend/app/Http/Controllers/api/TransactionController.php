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
            ->paginate(10);

        if($transactions) {
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $transactions
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
        $userId = Auth::id();
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
        ]);
    
        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
