@extends('root')
@section('title', 'Editar un objetivo')
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
                    <legend>Editar Objetivo</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Descripción</label>

                        <div class="col-lg-10">
                            <textarea rows="3" type="text" class="form-control" id="descripcion" placeholder="{!! $objetivo->description !!}" value="{!!$objetivo->description !!}" name="descripcion"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Lineamiento</label>

                        <div class="col-lg-10">
                            <select class="form-control" id="lineamiento" name="lineamiento[]" multiple>
                            @foreach ($lineamientos as $lineamiento)
                                    <option value="{!! $lineamiento->id !!}" 
                                    @if ($lineamiento->id === $objetivo->lineamiento_id)
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