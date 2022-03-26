<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berat extends Model
{
    protected $table = "berat";

    use HasFactory;

    protected $fillable = [
        'max_weight',
        'min_weight',
        'date',
    ];
}
