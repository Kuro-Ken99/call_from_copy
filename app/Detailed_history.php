<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailed_history extends Model
{
    protected $fillable = [
        'to_whom', 'from_whom', 'business', 'correspondence', 'phone_number', 'sent_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}
