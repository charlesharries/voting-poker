<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'uuid',
        'user_id',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function owner(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->users()->where('is_admin', 1)->first()
        );
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
