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
        $this->middleware('auth', ['except' => 'show']);
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
        // Este cambio lo hace con la imagen en el propio servidor, redimencionara y cortara de ser necesario.

        // Almacenar en la BD (Sin modelo)
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'preparacion' => $data['preparacion'],
        //     'ingredientes' => $data['ingredientes'],
        //     'imagen' => $rutaImagen,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria']
        // ]);
        //dd($request->all()); // visualizar los datos que se registraran

            auth()->user()->recetas()->create([
                'titulo' => $data['titulo'],
                'preparacion' => $data['preparacion'],
                'ingredientes' => $data['ingredientes'],
                'imagen' => $rutaImagen,
                'categoria_id' => $data['categoria']
            ]);

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
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit', compact('categorias', 'receta'));
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
        // Revisar que se cumpla la politica de uso
        $this->authorize('update', $receta);

        // Validación
        $data = request()->validate([
            'titulo' => 'required | min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            // 'imagen' => 'required | image | size:1000',
            'categoria' => 'required',
        ]);

        if(request('imagen')){
            $rutaImagen = $request['imagen']->store('upload-receta', 'public');
            // La variable en realidad ejecuta la instrucción y alamacena la ruta de la imagen dentro del servidor

            // Redimencionado de la imagen con Intervention/image
            $img = Image::make( public_path("storage/{$rutaImagen}"))-> fit(1000, 550);
            $img->save();

            $receta->imagen = $rutaImagen;
        }

        $receta->update([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $rutaImagen,
            'categoria_id' => $data['categoria']
        ]);

        // Metodo Alterno
        // $receta->titulo = $data['titulo'];
        // Se repite para todas la lineas deseadas y se guarda
        // $receta->save();

        

        return redirect('recetas/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        // Validación de la polica de uso
        $this->authorize('delete', $receta);
        
        // Eliminación
        $receta->delete();

        return redirect('recetas');
    }
}
