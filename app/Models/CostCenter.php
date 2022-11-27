<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'serie',
        'area_id',
        'sede_id',
        'business_id'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
