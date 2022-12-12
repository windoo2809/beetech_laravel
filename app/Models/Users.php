<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
*@property integer $id
*@property string  $email
*@property string  $user_name
*@property string  $birthday
*@property string  $first_name
*@property string  $last_name
*@property string  $password
*@property string  $reset_password
*@property string  $status
*@property integer $flag_delete
*/
class Users extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'email','user_name','birthday','first_name','last_name','password'
    ];
    protected $primarykey = 'id';
    protected $table = 'users';
}
