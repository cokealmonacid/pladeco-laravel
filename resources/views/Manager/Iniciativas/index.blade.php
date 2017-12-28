@extends('manager')
@section('title', 'Iniciativas')
@section('content')

	<div class="container col-md-8 col-md-offset-2">

	<a href="/manager/componentes"><< {!! $componente->name !!}</a>

	<div class="page-header" id="manager-inicio">
		<h1>Iniciativas</h1>
	</div>

    @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
    @endforeach

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

	@foreach($iniciativas as $iniciativa)
		@if($iniciativa->status != 5)
		<div class="panel panel-primary" id="iniciativa-show">

			<div class="panel-heading">
				<h3 class="panel-title">{!! $iniciativa->cartera !!}</h3>
			</div>

			<div class="panel-body">

				@if($iniciativa->status == 1)
					<div class="alert alert-info" role="alert">
						<p>Iniciativa editada</p>
					</div>
				@endif

				@if($iniciativa->status == 2)
					<div class="alert alert-warning" role="alert">
						<p>Iniciativa pendiente de aprobación</p>
					</div>
				@endif

				@if($iniciativa->status == 3)
					<div class="alert alert-danger" role="alert">
						<p><strong>Iniciativa Rechazada!</strong></p>
						<p>Es importante eliminar esta iniciativa, de esta forma se podrá visualizar la iniciativa antes de ser editada.</p>
					</div>
				@endif

				<p><strong>Objetivo: </strong>{!! $iniciativa->objetive !!}<p>
				<p><strong>Justificación: </strong>{!! $iniciativa->justify !!}<p>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Área de Influencia: </strong><br>{!! $iniciativa->area !!}</p>
					</div>
					<div class="col-md-4">
						<p><strong>Unidad Responsable: </strong><br>{!! $iniciativa->responsable !!}</p>
					</div>
					<div class="col-md-4">
						<p><strong>Unidad Co-resposable: </strong><br>{!! $iniciativa->coresponsable !!}</p>
					</div>	
				</div>

				<div class="row">
					<div class="col-md-12">
						<p><strong>Indicadores:</strong></p>
						@foreach($indicadores as $indicador)
							@if($indicador->iniciativa_id === $iniciativa->id)
								<p> - {!! $indicador->name !!}</p>
							@endif
						@endforeach
						@if($iniciativa->status == 1)
							<a href="{!! action('Manager\ManagerController@addIndicador', $iniciativa->id) !!}"><button type="button" class="btn btn-success agregar">Agregar Indicador</button></a>
						@endif
					</div>
				</div>	

				<div class="row">
					<div class="col-md-12">
						<p><strong>Actividades:</strong></p>
						@foreach($actividades as $actividad)
							@if($actividad->iniciativa_id === $iniciativa->id)
								<p> - {!! $actividad->name !!}</p>
							@endif
						@endforeach
						@if($iniciativa->status == 1)
							<a href="{!! action('Manager\ManagerController@addActividad', $iniciativa->id) !!}"><button type="button" class="btn btn-success agregar">Agregar Actividad</button></a>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col-md-12" id="boton-medios">

						<a href="{!! action('Manager\ManagerController@showMedios', $iniciativa->id) !!}"><button type="button" class="btn btn-success medio">Ver Medios de Verificación</button></a>

					</div>

						@if($iniciativa->status == 0)

						<div class="row">
							<div class="col-xs-6" id="botones">
								<a href="{!! action('Manager\ManagerController@editIniciativa', $iniciativa->id) !!}"><button type="button" class="btn btn-success modificar">Modificar Iniciativa</button></a>
							</div>
							<div class="col-xs-6" id="botones">
								<a href="{!! action('Manager\ManagerController@acceptIniciativa', $iniciativa->id) !!}"><button type="button" class="btn btn-success aceptar">Aceptar Iniciativa</button></a>
							</div>
						</div>

						@endif

						@if($iniciativa->status == 1)
						<div class="row">
							<div class="col-xs-6" id="botones">
								<a href="{!! action('Manager\ManagerController@deleteIniciativa', $iniciativa->id) !!}"><button type="button" class="btn btn-success cancelar">Cancelar Edición</button></a>
							</div>
							<div class="col-xs-6" id="botones">
								<a href="{!! action('Manager\ManagerController@makeRequest', $iniciativa->id) !!}"><button type="button" class="btn btn-success solicitud">Realizar Solicitud</button></a>
							</div>
						</div>
						@endif

				</div>
			</div>
		</div>
		@endif
	@endforeach
	
@endsection