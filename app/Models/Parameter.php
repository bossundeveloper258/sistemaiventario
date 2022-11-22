<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;
    const Status = 1;
    const StatusActive = 1;
    const StatusInactivective = 2;
}
