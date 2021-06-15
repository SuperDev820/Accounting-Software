<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleCondition extends Model
{
    use HasFactory;

    public $table = "m_condicionesventa";

    protected $fillable = [
        'CondicionVenta',
        'Descripcion',
    ];
}
