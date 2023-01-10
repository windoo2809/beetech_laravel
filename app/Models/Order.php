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
        'id','customer_id', 'quantity', 'total','created_at','updated_at'
    ];
    protected $primarykey = 'id';
    protected $table = 'orders';

    public function OrderDetail(){
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }

    public function CustomerDetail(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
