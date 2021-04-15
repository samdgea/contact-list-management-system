<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'phone_number',
        'created_by',
        'updated_by'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($customer) {
            $customer->created_by = Auth::user()->id;
            $customer->updated_by = Auth::user()->id;
        });

        static::updating(function ($customer) {
            $customer->updated_by = Auth::user()->id;
        });
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function agents()
    {
        return $this->belongsToMany(User::class);
    }

    public function followups()
    {
        return $this->hasMany(HistoryFollowup::class, 'customer_id', 'id');
    }
}
