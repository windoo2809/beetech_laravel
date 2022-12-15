<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
*@property integer $id
*@property string  $name
*@property integer $parent_id
*/
class ProductCategory extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name','parent_id'
    ];
    protected $primarykey = 'id';
    protected $table = 'product_category';
}
