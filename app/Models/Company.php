<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $table = "m_empresas";

    protected $fillable = [
        'IdEmpresa',
        'Descripcion',
        'Ruta',
        'Titulo',
        'Direccion',
        'Remite',
    ];

    public function series()
    {
        return $this->hasMany(SeriesInvoice::class, 'empresa_id');
    }
}
