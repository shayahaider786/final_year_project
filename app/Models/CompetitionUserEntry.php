<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionUserEntry extends Model
{
    use HasFactory;
    protected $fillable = [
        'competition_id',
        'name',
        'email',
        'instagram_name',
        'tiktok_name',
        'youtube_name',
    ];


    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
