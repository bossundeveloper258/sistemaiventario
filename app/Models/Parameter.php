<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    //
    const Status = 1;
    const StatusActive = 1;
    const StatusInactivective = 2;
    //
    const SedeType = 2;

    const TypeComputer = 3;
    const BrandComputer = 4;
    const ModelComputer = 5;
    const SOComputer = 6;
    const StatusComputer = 7;
    const SupplierComputer = 8;


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
