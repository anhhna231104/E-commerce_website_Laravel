<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Country extends Authenticatable 
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'country';
    protected $primaryKey = 'id_country';
    protected $fillable = [
        
        'name_country',
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
