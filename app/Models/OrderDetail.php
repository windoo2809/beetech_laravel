<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *@property integer $id
 *@property integer $order_id
 *@property integer $product_id
 *@property integer $quantity
 *@property integer $price
 *@property string $status
 */
class OrderDetail extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price', 'status','created_at','updated_at'
    ];
    protected $primarykey = 'id';
    protected $table = 'order_detail';

    /**
     * Get the product for the Order detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
