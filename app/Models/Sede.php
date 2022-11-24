<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'serie',
        'address',
        'sede_type_id',
        'business_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sede_type()
    {
        return $this->belongsTo(Parameter::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
