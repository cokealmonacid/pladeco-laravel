@extends('manager')
@section('title', 'Inicio')
@section('content')

    <div class="container col-md-8 col-md-offset-2">

	<a href="/manager/lineamientos"><< Volver</a>

		<div class="page-header" id="manager-inicio">
			<h1>Lineamiento : {!! $lineamiento->name !!}</h1>	
			<h3>Porcentaje de avance del lineamiento:</h3>
			<div class="progress">
			  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
   				<p>60% completado</p>
			  </div>
			</div>

			<h2>Objetivo</h2>				
		  	<h2><small>{!! $objetivo->description !!}</small></h2>
		  	<h4><strong>Encargado:</strong> {!! $user->name !!}</h4>
		</div>

		<div class="page-header" id="lineamientos-ajenos">

	<div class="page-header" id="manager-inicio">
				<h1>Componentes</h1>
				<p>Componentes asociados al Lineamiento</p>		
		</div>

		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="componentes">
					@foreach($componentes as $componente)
						@if($componente->lineamiento_id === $lineamiento->id)
							<div class="panel panel-success">
							  <div class="panel-heading">
							    <h3 class="panel-title">{!! $componente->name !!}</h3>
							  </div>
							  <div class="panel-body">
							    <p><strong>Objetivo:</strong> {!! $componente->objetive !!}</p>
								<div class="progress" id="componente-ajeno">
								  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: {!! $componente->id*rand(40,80) !!}">
					   				<p>{!! $componente->id*rand(5,10) !!} % completado</p>
								  </div>
								</div>
								<button id="more-administrador"><a href="/manager/componentes/{!! $componente->id !!}/iniciativas-lineamientos">Ver Iniciativas</a></button>
							  </div>
							</div>
						@endif
					@endforeach
		    </div>

		  </div>

		</div>


		</div>

    </div>

@endsection