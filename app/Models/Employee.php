<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'gpid',
        'name',
        'email',
        'job',
        'cost_center_id',
        'area_id',
        'business_id',
        'sede_id',
    ];

    public function cost_center()
    {
        return $this->belongsTo(CostCenter::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }
}
