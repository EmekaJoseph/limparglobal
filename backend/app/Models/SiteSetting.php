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

    /**
     * Who should be emailed when a form is submitted: the org's fixed inbox,
     * plus whatever contact email the admin has configured, if different.
     *
     * @return array<int, string>
     */
    public static function adminRecipients(): array
    {
        $default = 'limparglobal@gmail.com';
        $configured = static::current()->email;

        return collect([$default, $configured])
            ->filter()
            ->unique(fn (string $email) => strtolower($email))
            ->values()
            ->all();
    }
}
