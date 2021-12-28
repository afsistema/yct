<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Number extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'numbers';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function number_preferences()
    {
        return $this->hasMany(NumberPreference::class, 'number_id');
    }
}
