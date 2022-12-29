<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
*@property integer $id
*@property string  $phone
*@property string  $email
*@property string  $birthday
*@property string  $full_name
*@property string  $password
*@property string  $reset_password
*@property string  $address
*@property integer $province_id
*@property integer $district_id
*@property integer $commune_id
*@property string  $status
*@property integer $flag_delete
*/

class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens;

    public $timestamps = true;
    protected $fillable = [
        'email','phone','birthday','full_name','password','reset_password',
        'address','province_id','district_id','commune_id','status','flag_delete'
    ];
    protected $primarykey = 'id';
    protected $table = 'customer';

    protected $attributes = [
        'birthday'=> '2000-09-08',
        'full_name'=> '',
        'reset_password' => '',
        'address' => '',
        'province_id' => 1,
        'district_id'=> 1,
        'commune_id' => 1,
        'status' => '',
    ];
}
