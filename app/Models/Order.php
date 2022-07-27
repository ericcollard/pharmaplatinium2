<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordertemplatecontent_id',
        'user_id',
        'qty',
    ];

    public function pharmacy()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function orderTemplateContent()
    {
        return $this->belongsTo(OrderTemplateContent::class,'ordertemplatecontent_id');
    }

    public function totalValue()
    {
        $totalQty = $this->orderTemplateContent->totalQty();
        if ($this->orderTemplateContent->step_value && $this->orderTemplateContent->step_price && $totalQty >= $this->orderTemplateContent->step_value)
        {
            return $this->qty * $this->orderTemplateContent->step_price;
        }
        else
        {
            return $this->qty * $this->orderTemplateContent->price * (1.0-$this->orderTemplateContent->discount);
        }
    }


}
