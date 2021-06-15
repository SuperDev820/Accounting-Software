<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public $table = "m_bancos";

    protected $fillable = [
        'Nombre',
        'Oficina',
        'IBAN',
        'SWIFT',
    ];
}
