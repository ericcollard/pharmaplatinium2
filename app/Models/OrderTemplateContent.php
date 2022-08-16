<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderTemplateContent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ean',
        'ordertemplate_id',
        'name',
        'variant',
        'discount',
        'price',
        'step_price',
         'step_value',
        'package_qty',
        'demi_package',
        'multi_delivery',
        'free',
        'free_stp',
        'free_qty',
        'comment',
        'sort'
    ];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($orderTemplateContent)
        {
            $orderTemplateContent->orders->each->delete();
        });
    }


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
                return $orderDetail->qty * $this->price * (1.0-$this->discount);
            });
        }
    }

    public function duplicate($orderTemplateId = 0)
    {
        //reclassement des autres lignes
        DB::statement(
            'update order_template_contents set sort = sort + 1 where ordertemplate_id = :id and sort > :sort',
            ['id' => $this->ordertemplate_id,
                'sort' =>  $this->sort ]
        );

        $newOrderTemplateContent =$this->replicate();
        $newOrderTemplateContent->sort = $newOrderTemplateContent->sort +1;
        $newOrderTemplateContent->created_at = now();
        if ($orderTemplateId > 0) $newOrderTemplateContent->ordertemplate_id = $orderTemplateId;
        $newOrderTemplateContent->save();




        return $newOrderTemplateContent;
    }


}
