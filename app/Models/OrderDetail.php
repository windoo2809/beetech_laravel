<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price', 'status'
    ];
    protected $primarykey = 'id';
    protected $table = 'order_detail';
}
