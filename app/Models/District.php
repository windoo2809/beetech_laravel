<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
*@property integer $id
*@property string  $name
*@property integer  $province_id
*/
class District extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name','id','province_id'
    ];
    protected $primarykey = 'id';
    protected $table = 'district';
}
