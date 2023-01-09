<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 *@property integer $id
 *@property string $token
 */
class PasswordReset extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'token',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
    protected $table = 'password_resets';
}
