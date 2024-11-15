<?php

namespace App\Models;

use App\Models\MailingList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    public function mailingLists(): BelongsToMany
    {
        return $this->belongsToMany(MailingList::class);
    }

    public function department(): HasOne
    {
        return $this->hasOne(Affectation::class);
    }

    public function notations(): HasMany
    {
        return $this->hasMany(Notation::class);
    }

    public function latestNotation()
    {
        return $this->hasOne(Notation::class)->latestOfMany();
    }

}
