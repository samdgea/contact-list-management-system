<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    protected $table = 'customer_user';
    protected $fillable = [
        'user_id',
        'customer_id'
    ];
}
