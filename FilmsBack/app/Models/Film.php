<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    public function director()
    {
        return $this->belongsTo(Director::class);
    }
}
