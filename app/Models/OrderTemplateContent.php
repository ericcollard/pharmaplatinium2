<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTemplateContent extends Model
{
    use HasFactory;

    public function orderTemplate()
    {
        return $this->belongsTo(OrderTemplate::class,'ordertemplate_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'ordertemplatecontent_id');
    }

    public function totalQty()
    {
        return $this->orders->sum('qty');
    }

    public function totalValue()
    {
        $totalQty = $this->totalQty();
        if ($this->step_value && $this->step_price && $totalQty >= $this->step_value)
        {
            return $this->orders->sum(function($orderDetail) {
                return $orderDetail->qty * $this->step_price;
            });
        }
        else
        {
            return $this->orders->sum(function($orderDetail) {
                return $orderDetail->qty * $this->price;
            });
        }
    }


}
