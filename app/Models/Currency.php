<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public function prices() {
        return $this->belongsToMany(Price::class);
    }

    public function transactions() {
        return $this->belongsToMany(Transaction::class);
    }
}
