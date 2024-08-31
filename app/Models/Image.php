<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'imgname',
    ];
     // Define the inverse relationship with Customer
     public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
