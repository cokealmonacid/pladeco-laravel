@extends('root')
@section('title', 'Editar un Componente')
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
                    <legend>Editar un Componente</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="{!! $componente->name !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Objetivo</label>

                        <div class="col-lg-10">
                            <textarea type="text" class="form-control" rows="3" id="objetive" name="objetive" placeholder="{!! $componente->objetive !!}" value="{!! $componente->objetive !!}" ></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Lineamiento</label>

                        <div class="col-lg-10">
                            <select class="form-control" id="lineamiento" name="lineamiento[]" multiple>
                                @foreach($lineamientos as $lineamiento)
                                    <option value="{!! $lineamiento->id !!}"
                                    @if ($lineamiento->id === $componente->lineamiento_id)
                                        selected
                                    @endif
                                    >{!! $lineamiento->name !!}</option>
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
    <p><strong>Importante:</strong> Solo rellenar aquellos campos a editar, los demás se deben dejar en blanco.</p>
    </div>
@endsection