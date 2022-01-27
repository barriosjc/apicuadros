<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuadro extends Model
{
    use HasFactory;

    protected $table = 'cuadros';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'medidas',
        'estilo',
        'autor'
    ];


}
