<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Collateral extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_address',
        'material_name',
        'quantity',
        'kyat',
        'pel',
        'yway',
        'chan',
        'sate',
        'gem_included',
        'amount',
        'rate',
        'status',
        'user_id',
        'expired_date',
        'withdrawn_date',
        'withdrawn_by'
    ];
    //setting relationships between models
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function collateral_interests()
    {
        return $this->hasMany('App\CollateralInterest');
    }
    //getters 
    public function getGemIncludedAttribute($gem)
    {
        if($gem = 1)
        {
            $gemText = 'Yes';
        }
        else if($gem = 0)
        {
            $gemText = 'No';
        }
        return $gemText;
    }
    
    public function getExpiredDateAttribute($date)
    {
        return Carbon::parse($date)->toFormattedDateString();
    }
    public function getExpiredDateDiffForHumans($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->toFormattedDateString();
    }
    public function getCreatedAtDiffForHumans($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
    public function getSubtotal()
    {
        $exceededDay = Carbon::parse($this->created_at)->addDay()->diffInDays(Carbon::now());
        $subTotal = ((($this->rate/100) * $this->amount ) /30 ) * $exceededDay;
        return $subTotal;
    }
    public function getDuration()
    {
        $duration = Carbon::parse($this->created_at)->addDay()->diffForHumans(Carbon::now(), null, false, 2);
        return $duration;
    }
    public function getTotalBill()
    {
        $totalBill = $this->getSubTotal() - $this->collateral_interests->sum('paid_amount');
        if($totalBill < 0)
        {
            $extraPayment = $this->collateral_interests->sum('paid_amount') - $this->getSubTotal();
            return $totalBill = 0 .' ကျပ် (extra ' . $extraPayment .' ကျပ် already paid)';
        }
        else 
        {
            return $totalBill .' ကျပ်';
        }
    }
    public function setExpiredDateAttribute($month)
    {
        $this->attributes['expired_date'] = Carbon::now()->addMonths($month);
    }
    public function getKyatAttribute($kyat)
    {
        if($kyat)
        {
            return $kyat . ' ကျပ်';
        }
    }
    public function getPelAttribute($pel)
    {
        if($pel)
        {
            return $pel . ' ပဲ';
        }
    }
    public function getYwayAttribute($yway)
    {
        if($yway)
        {
            return $yway . ' ရွေး';
        }
    }
    public function getChanAttribute($chan)
    {
        if($chan)
        {
            return $chan . ' ချမ်း';
        }
    }
    public function getSateAttribute($sate)
    {
        if($sate)
        {
            return $sate . ' စိတ်';
        }
    }
    // customer getter for status
    public function getStatusText()
    {
        if($this->status == 0)
        {
            if(Carbon::now() > Carbon::parse($this->expired_date))
            {
                $statusText = 'Expired';
            }
            else
            {
                $statusText = 'Active';
            }
        }
        else if($this->status == 1)
        {
            $statusText = 'Withdrawn';
        }
        else if($this->status == 2)
        {
            $statusText = 'Invalid/Destroyed';
        }
        return $statusText;
    }
    //custom function for calculating rate
    public function calculateRate($rate, $amount)
    {
        $calculatedRate = ($rate / 100 ) * $amount;
        return $calculatedRate;
    }
    protected $table = 'collaterals';
}
