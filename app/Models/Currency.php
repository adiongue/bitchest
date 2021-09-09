<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];

    public function prices() {
        return $this->hasMany(Price::class);
    }

    public function transactions() {
        return $this->belongsToMany(Transaction::class);
    }
}
