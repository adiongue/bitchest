<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function user() {
        return $this->hasOne(User::class);
    }

    public function currency() {
        return $this->hasOne(Currency::class);
    }
}
