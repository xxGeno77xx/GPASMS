<?php

namespace App\Models;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MailingList extends Model
{
    public function staffs(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class);
    }
}
