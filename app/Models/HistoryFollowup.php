<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HistoryFollowup extends Model
{
    protected $table = 'history_followup';
    protected $fillable = [
        'customer_id',
        'old_status',
        'new_status',
        'remarks',
        'modified_by'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($customer) {
            $customer->modified_by = Auth::user()->id;
        });
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function modifiedby() {
        return $this->hasOne(User::class, 'id', 'modified_by');
    }
}
