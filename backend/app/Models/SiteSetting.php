<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['email', 'phone', 'linkedin'])]
class SiteSetting extends Model
{
    /**
     * There is only ever one row in this table. Fetch (or lazily create) it.
     */
    public static function current(): self
    {
        return static::query()->firstOrCreate([]);
    }
}
