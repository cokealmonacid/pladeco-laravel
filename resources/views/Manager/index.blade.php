@extends('manager')
@section('title', 'Inicio')
@section('content')



<div class="container col-md-10 col-md-offset-1">

	<div class="row header" id="manager-inicio">
		<div class="col-md-9">
			<h2>{!! $lineamiento->name !!}</h2>
			<p><strong>Objetivo:</strong> {!! $objetivo->description !!}</p>
			<p><strong>Encargado:</strong> {!! $user->name !!}</p>
		</div>
		<div class="col-md-3" id="logo-muni">
			<img src="{{ asset('images/logo.jpeg') }}">
		</div>
	</div>

	<div class="row avance" id="manager-inicio">
		<div class="col-lg-12">
			<h3>Porcentaje de Avance Total de Lineamiento</h3>

			<div class="progress">
			  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: {!! $porcentajeT !!}%" id="progress">
   				<p>{!! $porcentajeT !!}% completado</p>
			  </div>
			</div>
		</div>
	</div>	

	<div class="row details">
		<div class="col-md-6" id="details-col-1">
			<div id="manager-inicio">
				<h3>Detalle de Lineamiento</h3>
				<hr class="divider">
				<div class="row">
					<div class="col-xs-6">
						<p><strong>Componentes:</strong> {!! $cantComp !!}</p>
						<p><strong>Iniciativas Totales:</strong> {!! $cantIni !!}</p>
						<p><strong>Indicadores:</strong> {!! $cantInd !!}</p>						
					</div>
					<div class="col-xs-6">
						<p><strong>Actividades:</strong> {!! $cantAct !!}</p>
						<p><strong>Medios de Verificación:</strong> {!! $cantMV !!}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6" id="details-col-2">
			<div id="manager-inicio">
				<h3>Porcentaje de Avance por Componente:</h3>
				<hr class="divider">
				@foreach ($componentes as $componente)
					@if($lineamiento->id == $componente->lineamiento_id)
					<div class="row">
						<div class="col-md-5">
							<p>{!! substr($componente->objetive,0,50) !!} ...</p>
						</div>
						<div class="col-md-7">


							<div class="progress">
							  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: {!! $componente->porcentaje !!}%" id="progress">
				   				<p>{!! $componente->porcentaje !!}% completado</p>
							  </div>
							</div>


						</div>
					</div>
					@endif
				@endforeach
			</div>
		</div>
	</div>

</div>

@endsection