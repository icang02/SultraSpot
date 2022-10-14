<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'tour_place_id' => 'array',
        'quantity' => 'array',
    ];

    public function tour_place()
    {
        return $this->belongsTo(TourPlace::class, 'tour_place_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
