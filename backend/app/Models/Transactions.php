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

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function Expense_Categories() {

        return $this->belongsTo(Categories::class);
    }

    public function Payment_Methods() {

        return $this->belongsTo(Methods::class);
    }
}
