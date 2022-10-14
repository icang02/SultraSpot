<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPlace extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function user_orders()
    {
        // return $this->belongsTo(UserOrder::class, 'tour_place_id');
    }
}
