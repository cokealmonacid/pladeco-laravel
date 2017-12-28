@extends('administrador')
@section('title', 'Iniciativas')
@section('content')

	<div class="container col-md-8 col-md-offset-2">

	<a href="/administrador/lineamientos/{!! $lineamiento->id !!}/mostrar"><< {!! $componente->name !!}</a>

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

		    <div role="tabpanel" class="tab-pane" id="iniciativas">
		    		@foreach($iniciativas as $iniciativa)
		    			@if($iniciativa->componente_id === $componente->id)
		    						<div class="panel panel-success" id="iniciativa-show">

										<div class="panel-heading">
											<h3 class="panel-title">{!! $iniciativa->cartera !!}</h3>
										</div>

										<div class="panel-body">
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
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
												<p><strong>Medios de Verificación:</strong></p>
												<table class="table">
												    <thead>
												    <tr>
												        <th>Medio</th>
												        <th>Archivo</th>
												    </tr>
												    </thead>
												    <tbody>
												    @foreach($verificaciones as $verificacion)
														@if($verificacion->iniciativa_id === $iniciativa->id) 
												        <tr>
												            <td>{!! $verificacion->name !!}</td>
												            <td>
    															@if($verificacion->file === "")
    																<p>No hay archivos</p>
    															@else
    																<a href="/manager/download/{!! $verificacion->id !!}">Descargar</a>
    															@endif			
												            </td>
												         </tr>
												         @endif
												    @endforeach
												    </tbody>
												</table>
											</div>
										</div>				
									</div>
								</div>
		    			@endif
		    		@endforeach
		    </div>
	
@endsection