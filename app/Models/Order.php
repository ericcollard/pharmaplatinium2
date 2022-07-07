<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function pharmacy()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function orderTemplateContent()
    {
        return $this->belongsTo(OrderTemplateContent::class,'ordertemplatecontent_id');
    }



}
