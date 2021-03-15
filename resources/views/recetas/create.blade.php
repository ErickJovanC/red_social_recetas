@extends('layouts.app')

@section('styles')
{{-- <link rel="stylesheet" href="{{ asset('css/trix.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/trix.css') }}" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Volver</a>
@endsection
@section('content')
    <h2 class="text-center mb-5">Crear Recetas</h2>
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <form action="{{ route('recetas.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="titulo">Titulo Receta</label>
                    <input 
                        type="text"
                        name="titulo" 
                        class="form-control @error('titulo') is-invalid @enderror"
                        id="titulo"
                        placeholder="Titulo Receta"
                        value="{{ old('titulo') }}"
                    />

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name="categoria" 
                        id="categoria" 
                        class="form-control @error('categoria') is-invalid @enderror"
                    >
                        <option value="" hidden>Selecciona una categoria</option>
                        @foreach ($categorias as $id => $categoria)
                        <option 
                            value="{{ $id }}"
                            {{ old('categoria') == $id ? 'selected' : '' }}
                        >
                            {{$categoria}}
                        </option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="preparacion">Preparación</label>
                    <input 
                        id="preparacion" 
                        type="hidden" 
                        name="preparacion" 
                        value="{{ old('preparacion') }}"
                    />
                    <trix-editor 
                        input="preparacion" class="form-control @error('preparacion') is-invalid @enderror">
                    </trix-editor>

                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="ingredientes">Ingredientes</label>
                    <input 
                        id="ingredientes" 
                        type="hidden" 
                        name="ingredientes" 
                        value="{{ old('ingredientes') }}"
                    />
                    <trix-editor 
                        input="ingredientes" 
                        class="form-control @error('ingredientes') is-invalid @enderror">
                    </trix-editor>
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="imagen">Seleccione una imagen</label>
                    <input type="file"
                        class="form-control @error('imagen') is-invalid @enderror"
                        name="imagen"
                        id="imagen"
                    >
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Receta">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script src="{{ asset('js/trix.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/trix.js') }}" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
@endsection