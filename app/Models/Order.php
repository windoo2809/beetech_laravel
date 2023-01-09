<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *@property integer $id
 *@property integer $customer_id
 *@property integer $quantity
 *@property integer $total
 */
class Order extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'customer_id', 'quantity', 'total'
    ];
    protected $primarykey = 'id';
    protected $table = 'orders';
}
