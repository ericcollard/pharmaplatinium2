<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTemplate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'dead_line',
        'franco',
        'brand_id',
        'comment',
        'status',
        'multi_deliveries',
    ];

    protected $with = ['brand'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dead_line' => 'datetime',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function content()
    {
        return $this->hasMany(OrderTemplateContent::class,'ordertemplate_id');
    }

    public function totalValue()
    {
        return $this->content->sum(function($orderDetail) {
            return $orderDetail->totalValue();
        });
    }
}
