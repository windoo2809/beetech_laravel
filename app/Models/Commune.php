<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
*@property integer $id
*@property string  $name
*@property integer  $district_id
*/
class Commune extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name','id','district_id'
    ];
    protected $primarykey = 'id';
    protected $table = 'commune';
}
