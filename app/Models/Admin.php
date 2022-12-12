<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
*@property integer $id
*@property string  $user_name
*@property string  $email
*@property string  $birthday
*@property string  $first_name
*@property string  $last_name
*@property string  $password
*@property string  $reset_password
*@property string  $status
*@property integer $flag_delete
*/
class Admin extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'username','email','birthday','first_name','last_name','password','reset_password','status','flag_delete'
    ];
    protected $primarykey = 'id';
    protected $table = 'admin';
}
