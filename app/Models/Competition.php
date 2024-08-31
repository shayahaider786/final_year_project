<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'description',
        'video_path',
        'prize1_image_path',
        'prize1_description',
        'prize2_image_path',
        'prize2_description',
        'prize3_image_path',
        'prize3_description',
        'insta_link',
        'tiktok_link',
        'youtube_link',
    ];

    public function competitionUserEntries()
    {
        return $this->hasMany(CompetitionUserEntry::class);
    }
}
