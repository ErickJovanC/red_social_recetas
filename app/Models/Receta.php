<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    
    // Campos que se agregaran evitando inyección SQL
    protected $fillable = [
        'titulo',
        'preparacion',
        'ingredientes',
        'imagen',
        'categoria_id'
    ];

    // Se obtiene la categoria por medio del id_categoria
    // Se usa belongsTo para un relación de muchos a 1
    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }
}
