<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_Announcement extends Model
{
    use HasFactory;
    protected $table = 'item_announcements';
    protected $fillable = [
        'announcement_id',
        'item_id',
        'percent_min',
        'percent_max',
    ];
}
