<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notation extends Model
{
    public function notations(): BelongsTo
    {
        return $this->belongsTo(Staff::class); 
    }
}
