<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'contact_email',
        'contact_phone',
        'contact_name',
        'discount',
        'manager_id',
        'comment'
    ];

    /**
     * Default values for attributes
     * @var  array an array with attribute as key and default as value
     */
    protected $attributes = [
        'discount' => 0.0,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'discount' => 'double',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id');
    }

    public function path()
    {
        return route('brand.show', $this);
    }


}
