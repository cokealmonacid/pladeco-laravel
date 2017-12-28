@extends('administrador')
@section('title', 'Inicio')
@section('content')

    <div class="container col-md-8 col-md-offset-2">

        <div class="row" id="manager-inicio">
        	<div class="col-md-9">
                <h1>Administrador Municipal</h1>   
            </div>
            <div class="col-md-3" id="logo-muni-2">
                <img src="{{ asset('images/logo.jpeg') }}">
            </div>
        </div>

        @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

    	<div class="page-header" id="manager-inicio">
    		<h3>Medios de Verificación pendientes</h3>
    		@if($count != 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>Medio</th>
                        <th>Archivo</th>
                        <th>Lineamiento</th>
                        <th>Iniciativa</th>
                        <th>Verificar</th>
                        <th>Rechazar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($medios as $medio)
                        <tr>
                            <td>{!! $medio->name !!}</td>
                            <td><a href="/manager/download/{!! $medio->id !!}">Descargar</a></td>
                            <td>
                                @foreach($iniciativasMV as $imv)
                                    @if($imv->id === $medio->iniciativa_id)
                                        @foreach($componentes as $componente)
                                            @if($componente->id === $imv->componente_id)
                                                @foreach($lineamientos as $lineamiento)
                                                    @if($lineamiento->id === $componente->lineamiento_id)
                                                        {!! $lineamiento->name !!}
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($iniciativasMV as $imv)
                                    @if($imv->id === $medio->iniciativa_id)
                                        {!! substr($imv->objetive,0,30) !!}...
                                    @endif
                                @endforeach
                            </td>
                            <td>
                            <a href="/administrador/accept/{!! $medio->id !!}">
                                <button type="button" class="btn btn-default" aria-label="Center Align">
								  <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green"></span>
								</button>
                            </a>
							</td>
                            <td>
                            <a href="/administrador/reject/{!! $medio->id !!}">
                                <button type="button" class="btn btn-default" aria-label="Center Align">
                                  <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span>
                                </button>
                            </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay medios de verificación por validar</p>
    		@endif

    	</div>

        <div class="page-header" id="manager-inicio">
            <h3>Iniciativas pendientes</h3>
            @if($countIniciativas != 0)
                    @foreach($iniciativas as $iniciativa)
                        @foreach($componentes as $componente)
                            @if($componente->id === $iniciativa->componente_id)
                                @foreach($lineamientos as $lineamiento)
                                    @if($lineamiento->id === $componente->lineamiento_id)
                                        <h3>{!! $lineamiento->name !!}</h3>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
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
                    <div class="row" id="iniciativa-pendiente">
                    <div class="col-xs-6" id="botones">
                        <a href="{!! action('Administrador\AdministradorController@rejectRequest', $iniciativa->id) !!}"><button type="button" class="btn btn-success medio"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:white"></span> Rechazar Solicitud</button></a>
                    </div>
                    <div class="col-xs-6" id="botones">
                        <a href="{!! action('Administrador\AdministradorController@acceptRequest', $iniciativa->id) !!}"><button type="button" class="btn btn-success solicitud"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:white"></span> Aceptar Solicitud</button></a>
                    </div>
                    </div>
                    @endforeach
            @else
                <p>No hay medios de verificación por validar</p>
            @endif

        </div>

    </div>


@endsection