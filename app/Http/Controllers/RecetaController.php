<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recetas = Auth::user()->recetas; // Esto trae solo las recetas del usuario
        //$recetas = DB::table('recetas')->get(); // Esto trae todas la recetas
        return view('recetas.index')->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('categoria_receta')-> get()->pluck('nombre', 'id') -> dd();

        // Obtener Categorias (Sin modelo)
        // Consulta a la BD de elementos seleccionador pluck()
        // $categorias = DB::table('categoria_recetas')-> get()->pluck('nombre', 'id');

        //Con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create')-> with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación
        $data = request()->validate([
            'titulo' => 'required | min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            // 'imagen' => 'required | image | size:1000',
            'categoria' => 'required',
        ]);

        // Obtención de la ruta de la imagen
        // La imagen deberá ir despues de la validación para evitar que no sea reconocida
        $rutaImagen = $request['imagen']->store('upload-receta', 'public');
        // La variable en realidad ejecuta la instrucción y alamacena la ruta de la imagen dentro del servidor

        // Redimencionado de la imagen con Intervention/image
        $img = Image::make( public_path("storage/{$rutaImagen}"))-> fit(1000, 550);
        $img->save();
        // Este cambio lo hace con la imagen en el propio servidor

        // Almacenar en la BD (Sin modelo)
        DB::table('recetas')->insert([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $rutaImagen,
            'user_id' => Auth::user()->id,
            'categoria_id' => $data['categoria']
        ]);
        //dd($request->all());
        return redirect('/recetas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }
}
