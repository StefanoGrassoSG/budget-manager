<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//models
use App\models\User;

class Monthly_Budget extends Model
{
    use HasFactory;

    public function User() {

        return $this->belongsTo(User::class);
    }
}
