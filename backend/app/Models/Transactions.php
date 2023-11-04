<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//models
use App\models\User;
use App\models\Categories;
use App\models\Methods;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'description',
        'amount',
        'methods_id',
        'category_id',
        'user_id',
        'monthly_budget_id'
    ];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function Expense_Categories() {

        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function  paymentMethod() {

        return $this->belongsTo(Methods::class, 'methods_id');
    }
}
