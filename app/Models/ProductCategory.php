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
        'name', 'parent_id', 'created_at', 'updated_at'
    ];
    protected $primarykey = 'id';
    protected $table = 'product_category';

    public function categoryChildren()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id', 'id');
    }
}
