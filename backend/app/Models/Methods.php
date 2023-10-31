<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//models
use App\models\Transactions;

class Methods extends Model
{
    use HasFactory;

    public function Transaction() {

        return $this->hasMany(Transactions::class);
    }
}
