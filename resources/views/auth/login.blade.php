@extends('master')
@section('name', 'Login')

@section('content')
    <div class="container col-md-6 col-md-offset-3">

        <div class="img-logo">
            <img src="{{ asset('images/logo.jpeg') }}">
        </div>

        <div class="well well bs-component">

            <form class="form-horizontal" method="post" id="login-template">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                 {!! csrf_field() !!}

                <fieldset>
                    <legend>Sistema de seguimiento y evaluación Plan de Desarrollo Comunal  2015-2019</legend>

                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control"  name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection