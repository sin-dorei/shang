<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
