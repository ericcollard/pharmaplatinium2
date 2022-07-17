<?php

namespace App\Models;

use DateInterval;
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
        'franco_required'
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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($orderTemplate)
        {
            $orderTemplate->content->each->delete();
        });
    }


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

    public function path()
    {
        return route('orderTemplate.show', $this);
    }

    public function duplicate()
    {
        $newOrderTemplate =$this->replicate();
        $newOrderTemplate->created_at = now();
        $newOrderTemplate->dead_line = date_add(now(),DateInterval::createFromDateString('1 month'));
        $newOrderTemplate->title = 'Copie de '.$newOrderTemplate->title;
        $newOrderTemplate->status = 'Brouillon';
        $newOrderTemplate->save();

        foreach ($this->content as $item)
        {
            $newContent = $item->duplicate($newOrderTemplate->id);
        }

        return $newOrderTemplate;
    }
}
