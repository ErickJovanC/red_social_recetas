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
    // Se usa belongsTo para un relación de muchos a 1 (Muchas recetas tienen una categoria)
    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }

    //Obtener la información del autor (user) via FK
    public function autor(){
        return $this->belongsTo(User::class, 'user_id'); // FK de esta tabla
    }
}
