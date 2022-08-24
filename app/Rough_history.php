<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rough_history extends Model
{
    protected $fillable = [
        'to_whom', 'from_whom', 'business', 'sent_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'to_whom');
    }
}
