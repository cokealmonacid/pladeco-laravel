@extends('root')
@section('title', 'Crear una Iniciativa')
@section('content')
    <div class="container col-md-6 col-md-offset-3">
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
                    <legend>Crear una Iniciativa</legend>
                    <div class="form-group">
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
                            <textarea class="form-control" rows="3" id="objetive" name="objetive"></textarea>
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
                        <label for="select" class="col-lg-2 control-label">Componente</label>

                        <div class="col-lg-10">
                            <select class="form-control" id="componente" name="componente[]" multiple>
                                @foreach($componentes as $componente)
                                    <option value="{!! $componente->id !!}">{!! $componente->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection