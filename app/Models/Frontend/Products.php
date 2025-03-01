<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'id_user',
        'id_brand',
        'id_category',
        'image',
        'name',
        'price',
        'status',
        'sale',
        'detail',
        'company_profile',
    ];
    public $timestamps = true;
}
