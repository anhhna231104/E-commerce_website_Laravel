<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';
    protected $fillable = [
        'email',
        'phone',
        'name',
        'id_user',
        'price',
    ];
    public $timestamps = true;

}
