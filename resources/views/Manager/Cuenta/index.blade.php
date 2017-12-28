@extends('manager')
@section('title', 'Cuenta de usuario')
@section('content')

	<div class="container col-md-4 col-md-offset-4">

		<div class="row header" id="manager-cuenta">
            <div class="panel-heading">
                <h2> Cuenta de Usuario </h2>
            </div>


            <div class="panel-body">
            	<p><strong>Nombre encargado: </strong>{!! $user->name !!}</p>
            	<p><strong>Correo electrónico: </strong>{!! $user->email !!}</p>
            	<hr>
            	<h4>Cambiar password</h4>


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
	                    <div class="form-group">
	                        <label for="name" class="col-lg-2 control-label">Nuevo password:</label>

	                        <div class="col-lg-10">
	                            <input type="password" class="form-control" id="pass" placeholder="password" name="pass">
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="name" class="col-lg-2 control-label">Confirmar nuevo password:</label>

	                        <div class="col-lg-10">
	                            <input type="password" class="form-control" id="new-pass" placeholder="password" name="new-pass">
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <div class="col-lg-4 col-lg-offset-3">
	                            <button type="submit" class="btn btn-primary">Cambiar password</button>
	                        </div>
	                    </div>
	                </fieldset>
	            </form>
            </div>	
		</div>

	</div>

@endsection