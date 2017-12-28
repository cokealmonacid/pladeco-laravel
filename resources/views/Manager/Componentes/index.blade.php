@extends('manager')
@section('title', 'Inicio')
@section('content')

    <div class="container col-md-8 col-md-offset-2">

		<div class="row page-header" id="manager-inicio">
			<div class="col-md-9">
				<h1>Componentes</h1>
				<p>Componentes asociados al Lineamiento</p>		
			</div>
			<div class="col-md-3" id="logo-muni-2">
				<img src="{{ asset('images/logo.jpeg') }}">
			</div>
		</div>

		@foreach($componentes as $componente)
				<div class="panel panel-primary" id="componente-container">
				  <div class="panel-heading">
				    <h3 class="panel-title">{!! $componente->name !!}</h3>
				  </div>
				  <div class="panel-body">
					<div class="progress">
					  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: {!! $componente->porcentaje !!}%" id="progress">
		   				<p>{!! $componente->porcentaje !!}% completado</p>
					  </div>
					</div>
				    <p><strong>Objetivo:</strong> {!! $componente->objetive !!}</p>
				    <button id="more"><a href="/manager/componentes/{!! $componente->id !!}/iniciativas">Ver Iniciativas</a></button>
				  </div>
				</div>
		@endforeach
    </div>


@endsection