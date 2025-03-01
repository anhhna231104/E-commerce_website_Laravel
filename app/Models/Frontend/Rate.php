<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $table = 'rate';
    protected $fillable = [
        'rate',
        'id_blog',
        'id_user'
    ];
    public $timestamps = true;
}
