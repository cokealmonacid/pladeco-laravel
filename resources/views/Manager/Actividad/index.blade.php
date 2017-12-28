@extends('manager')
@section('title', 'Crear una Actividad')
@section('content')
    <div class="container col-md-6 col-md-offset-3">

        <a href="/manager/componentes/{!! $iniciativa->componente_id !!}/iniciativas"><< Volver</a>   
            
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                {!! csrf_field() !!}

                <fieldset>
                    <legend>Crear Actividad</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="Nombre" name="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Iniciativa</label>

                        <div class="col-lg-10">
                        <p><strong>{!! $iniciativa->cartera !!}</strong></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default"><a href="/manager/componentes/{!! $iniciativa->componente_id !!}/iniciativas">Cancelar</a></button>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection