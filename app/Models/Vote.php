<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    public static $options = [1, 2, 3, 5, 8, 13, 21];

    public $fillable = ['user_id', 'room_id', 'value'];
}
