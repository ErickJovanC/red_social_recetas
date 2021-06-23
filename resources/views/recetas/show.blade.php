@extends('layouts.app')

@section('content')
    {{-- <h1>{{$receta}}</h1> --}}
    <article class="contenido-receta">
        <h1 class="text-center mb-4">{{ $receta->titulo }}</h1>
        <div class="imagen-receta">
            <img src="/storage/{{ $receta->imagen }}" alt="Imagen Receta" class="w-100">
        </div>
        <div class="receta-meta mt-2">
            <p>
                <span class="font-weight-bold text-primary">Escrito en:</span>
                {{ $receta->categoria->nombre }}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Autor:</span>
                {{ $receta->autor->name }}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Fecha de creación:</span>

                @php
                    $fecha = $receta->created_at
                @endphp

                <fecha-receta fecha="{{ $fecha }}"></fecha-receta>
                {{-- <fecha-receta fecha="{{ $receta->created_at }}"></fecha-receta> --}}
            </p>


            <div class="ingredientes">
                <h2 class="my-3 text-primary">Ingredientes</h2>
                {!! $receta->ingredientes !!} {{-- Esto mostrará el contenido como html en vez de imprimir las etiquetas --}}
            </div>
            <div class="preparacion">
                <h2 class="my-3 text-primary">Preparacion</h2>
                {!! $receta->preparacion !!} {{-- Esto mostrará el contenido como html en vez de imprimir las etiquetas --}}
            </div>

        </div>
    </article>
@endsection