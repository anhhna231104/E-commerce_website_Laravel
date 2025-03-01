<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'email',
        'password',
        'remember_me'
    ];
    public $timestamps = true;
}
