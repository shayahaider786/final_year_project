<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerData extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'customer_data';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name',
        'email',
        'phone',
        'plan',
        'payment_status',
    ];
}
