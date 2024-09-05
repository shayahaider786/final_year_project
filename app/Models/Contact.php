<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\ContactMail;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'surname','email','message'
    ];

    public static function boot() {
  
        parent::boot();
  
        static::created(function ($item) {
            $adminEmail = "info@qrobyte.net";
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }
}
