<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'date'];

    public function currencies() {
        return $this->belongsToMany(Currency::class);
    }
}
