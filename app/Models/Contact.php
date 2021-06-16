<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $table = "contactos";

    protected $fillable = [
        'Nombre',
        'Organizacion',
        'Departamento',
        'Puesto',
        'Email',
        'PaginaWeb',
        'TelTrabajo',
        'TelTrabajo2',
        'TelParticular',
        'TelMovil',
        'Fax',
        'DireccionTrabajo',
        'DireccionParticular',
        'ArchivarComo',
        'NIF',
        'Observaciones',
        'FormulaComision',
        'Moneda',
    ];
}
