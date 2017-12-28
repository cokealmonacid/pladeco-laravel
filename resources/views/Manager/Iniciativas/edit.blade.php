@extends('manager')
@section('title', 'Editar Iniciativa')
@section('content')

	<div class="container col-md-8 col-md-offset-2">

        @foreach($componentes as $componente)
            @if($componente->id === $iniciativa->componente_id)    
                <a href="/manager/componentes/{!! $componente->id !!}/iniciativas"><< Volver</a>
            @endif
        @endforeach

	<div class="page-header" id="manager-inicio">
		<h2>Edición de Iniciativa</h2>
	</div>
        <div class="well well bs-component">

            <form class="form-horizontal" method="post" id="edit-iniciativa">

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
                    <p class="alert alert-danger">Si se desea mantener la información actual, dejar la casilla correspondiente sin rellenar</p>
                    <div class="form-group">
                        <p><strong>Cartera de Iniciativas: </strong>{!! $iniciativa->cartera !!}</p>
                        <p><strong>Justificación: </strong>{!! $iniciativa->justify !!}</p>
                        <p><strong>Cartera: </strong>{!! $iniciativa->objetive !!}</p>
                        <p><strong>Area: </strong>{!! $iniciativa->area !!}</p>
                        <p><strong>Unidad Responsable: </strong>{!! $iniciativa->responsable !!}</p>
                        <p><strong>Unidad Co-responsable: </strong>{!! $iniciativa->coresponsable !!}</p>


                        <label for="cartera" class="col-lg-2 control-label">Cartera de Iniciativas de Inversión o gestión</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="cartera" name="cartera">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Justificacion</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="justificacion" name="justificacion">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Objetivos</label>

                        <div class="col-lg-10">
                            <textarea class="form-control" id="objetive" name="objetive"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Area de Influencia</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="area"  name="area">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Unidad Responsable</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="responsable"  name="responsable">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Unidad Co-responsable</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="coresponsable"  name="coresponsable">
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">
                        @foreach($componentes as $componente)
                            @if($componente->id === $iniciativa->componente_id)    
                                <p><strong>Componente: </strong>{!! $componente->name !!}</p>
                            @endif
                        @endforeach
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">
                            @foreach($componentes as $componente)
                                @if($componente->id === $iniciativa->componente_id)    
                                    <a href="/manager/componentes/{!! $componente->id !!}/iniciativas">Cancelar</a>
                                @endif
                            @endforeach
                            </button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

	</div>
	
@endsection