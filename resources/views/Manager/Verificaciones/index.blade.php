@extends('manager')
@section('title', 'Lineamientos')
@section('content')

    <div class="container col-md-8 col-md-offset-2">

        <a href="/manager/componentes/{!! $iniciativa->componente_id !!}/iniciativas"><< Volver</a>

    	<div class="page-header" id="manager-inicio">
 			<h2>Iniciativa:</h2>
 			<h2><small>{!! $iniciativa->cartera !!}</small></h2>
 		</div>

    @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
    @endforeach

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($iniciativa->status === 1)
        <div class="page-header" id="manager-inicio">
            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}

                <fieldset>
                    <legend>Crear Medio de Verificación</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="Nombre" name="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default"><a href="/manager/componentes/{!! $iniciativa->componente_id !!}/iniciativas">Cancelar</a></button>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    @endif

 		@foreach ($medios as $medio)
        @if($medio->iniciativa_id === $iniciativa->id)
 		<div class="page-header" id="manager-inicio">
 			<p>{!! $medio->name !!}</p>

 			@if($medio->status === 0)
 				<form method="POST" action="/manager/medios-de-verificacion/{!! $medio->id !!}/upload" enctype="multipart/form-data">

                        {!! csrf_field() !!}

                        <div class="form-group row">
                            <!--
                        	<div class="col-md-3" id="label_input_file">
                        		<label for="image" id="file">Elegir un Archivo</label>
                            </div>

                        	<div class="col-md-9" id="input_file">
                                <input type="file" id="file" name="file">
                        	</div>
                        -->
                                <span class="btn btn-info btn-file">
                                    <label for id="fileupload">Elegir un Archivo</label>
                                    <input id="file" class="upload" type="file" name="file" onchange="javascript:updateList()">
                                </span>
                                <div id="fileList"></div>
                                <script>
                                    updateList = function() {
                                      var input = document.getElementById('file');
                                      var output = document.getElementById('fileList');

                                      output.innerHTML = '<h4>' + input.value + '</h4>'
                                    }
                                </script>
                        </div>

                        <div class="row">
                        	<div class="col-xs-12">
                    			<button type="submit" class="btn btn-default upload-file">Subir</button>
                        	</div>
                        </div>
                </form>
 			@endif

 			@if($medio->status === 1)
 				<div class="alert alert-warning" role="alert" id="verificacion-alert">
				  <p>Medio de verificación pendiente de aprobación por parte del Administrador Municipal</p>
				</div>

                <div class="row" id="file-data">
                    <div class="col-md-6">
                        <p><strong>Archivo:</strong><a href="/manager/download/{!! $medio->id !!}">{!! $medio->file !!}</a></p>
                    </div>
                    <div class="col-md-6" id="boton-eliminar">
                        <p><strong>Eliminar:</strong><a href="{!! action('Manager\ManagerController@deleteFile', $medio->id) !!}"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a></p>
                    </div>
                </div>
 			@endif

 			@if($medio->status === 2)
 				<div class="alert alert-success" role="alert" id="verificacion-alert">
				  <p>Medio de verificación aprobado por parte del Administrador Municipal</p>
				</div>
                <div class="row" id="file-data">
                        <div class="col-md-12">
                            <p><strong>Archivo:</strong><a href="/manager/download/{!! $medio->id !!}">{!! $medio->file !!}</a></p>
                        </div>
                    </div>
 			@endif
            @if($medio->status === 3)
                <div class="alert alert-danger" role="alert" id="verificacion-alert">
                  <p>El medio de verificación ha sido rechazado por el Administrador Municipal.</p>
                  </div>
                    <form method="POST" action="/manager/medios-de-verificacion/{!! $medio->id !!}/upload" enctype="multipart/form-data">

                            {!! csrf_field() !!}

                            <div class="form-group row">
                                <span class="btn btn-info btn-file">
                                    <label for id="fileupload">Elegir un Archivo</label>
                                    <input id="file" class="upload" type="file" name="file" onchange="javascript:updateList()">
                                </span>
                                <div id="fileList"></div>
                                <script>
                                    updateList = function() {
                                      var input = document.getElementById('file');
                                      var output = document.getElementById('fileList');

                                      output.innerHTML = '<h4>' + input.value + '</h4>'
                                    }
                                </script>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-default upload-file">Subir</button>
                                </div>
                            </div>
                    </form>
            @endif
 		</div>
        @endif
 		@endforeach
    </div>


@endsection