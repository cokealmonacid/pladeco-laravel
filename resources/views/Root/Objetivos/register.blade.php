@extends('root')
@section('title', 'Crear un Objetivo')
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
                    <legend>Crear Objetivo</legend>
                    <div class="form-group">
                        <label for="objetivo" class="col-lg-2 control-label">Descripción de objetivo</label>

                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="descripcion" name="descripcion"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Lineamiento a asignar</label>

                        <div class="col-lg-10">
                            <select class="form-control" id="lineamiento" name="lineamiento[]" multiple>
                            @foreach($lineamientos as $lineamiento)
                                <option>{!! $lineamiento->name !!}</option>
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