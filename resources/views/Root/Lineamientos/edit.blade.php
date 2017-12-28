@extends('root')
@section('title', 'Editar un Lineamiento')
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

                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

                {!! csrf_field() !!}

                <fieldset>
                    <legend>EditarLineamiento</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="{!! $lineamiento->name !!}" value="{!!$lineamiento->name !!}" name="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Usuario</label>

                        <div class="col-lg-10">
                            <select class="form-control" id="user" name="user[]" multiple>
                            @foreach ($users as $user)
                                    <option value="{!! $user->id !!}" 
                                    @if ($user->id === $lineamiento->user_id)
                                        selected
                                    @endif    
                                    >{!! $user->name !!}</option>
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