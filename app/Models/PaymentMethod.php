<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public $table = "m_formaspago";

    protected $fillable = [
        'ValorOperaciones',
        'Descripcion',
        'NFracciones',
    ];
}
