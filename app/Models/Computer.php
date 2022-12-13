<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'brand_id',
        'model_id',
        'number_serie',
        'number_inventory',
        'act_fijo',
        'name',
        'so_id',
        'cod_bitlocker',
        'processor',
        'ram',
        'hdd',
        'date_start_guarantee',
        'date_exp_guarantee',
        'date_capital',
        'status_id',
        'number_capex',
        'name_capex',
        'pep_number',
        'solped',
        'oc',
        'pe_migo',
        'factura',
        'amount',
        'supplier_id',
        'business_id',
        'sede_id',
        'area_id',
        'ceco_id',
        'employee_id',
        'user_id'
    ];

    public function type()
    {
        return $this->belongsTo(Parameter::class, 'type_id');
    }

    public function brand()
    {
        return $this->belongsTo(Parameter::class, 'brand_id');
    }

    public function model()
    {
        return $this->belongsTo(Parameter::class, 'model_id');
    }

    public function so()
    {
        return $this->belongsTo(Parameter::class, 'so_id');
    }

    public function status()
    {
        return $this->belongsTo(Parameter::class, 'status_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Parameter::class, 'supplier_id');
    }

    public function ceco()
    {
        return $this->belongsTo(CostCenter::class, 'ceco_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
