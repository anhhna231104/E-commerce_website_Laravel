<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Blog extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'blog';
    protected $fillable = [

        'title',
        'image',
        'description',
        'content'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     */

    /**
     * Get the attributes that should be cast.
     **/
    public $timestamps = true;

}
