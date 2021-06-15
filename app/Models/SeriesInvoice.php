<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesInvoice extends Model
{
    use HasFactory;

    public $table = "m_seriesfacturas";

    protected $fillable = [
        'empresa_id',
        'Letra',
        'Numero',
        'Anio',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'empresa_id');
    }
}
