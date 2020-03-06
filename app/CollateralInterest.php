<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CollateralInterest extends Model
{
    protected $fillable = ['collateral_id', 'paid_amount', 'paid_month',  'user_id'];

    public function collateral()
    {
        return $this->belongsTo('App\Collateral');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->toFormattedDateString();
    }
    public function getCreatedAtDiffForHumans($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
    protected $table = 'collateral_interests';
}
