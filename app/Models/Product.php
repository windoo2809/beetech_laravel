<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
*@property integer $id
*@property string  $sku
*@property string  $user_name
*@property string  $stock
*@property string  $avatar
*@property string  $expired_at
*@property integer  $category_id
*@property integer  $flag_delete

*/
class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'sku','user_name','stock','avatar','expired_at','category_id','flag_delete',
    ];
    protected $primarykey = 'id';
    protected $table = 'product';
}
