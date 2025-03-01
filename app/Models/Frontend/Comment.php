<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'cmt',
        'id_user',
        'id_blog',
        'user_avatar',
        'username',
        'level',
    ];
    public $timestamps = true;

}
