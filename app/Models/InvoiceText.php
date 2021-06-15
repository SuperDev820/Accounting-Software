<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceText extends Model
{
    use HasFactory;

    public $table = "m_texto_facturas";

    protected $fillable = [
        'Descripcion',
    ];
}
