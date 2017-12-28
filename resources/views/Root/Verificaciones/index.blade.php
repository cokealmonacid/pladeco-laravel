@extends('root')
@section('title', 'Indicadores')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Indicadores </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($verificaciones->isEmpty())
                <p> No existen Indicadores.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Iniciativa</th>
                        <th>Medio verificador</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($verificaciones as $verificacion)
                        <tr>
                            <td>{!! $verificacion->id !!}</td>
                            <td>
                                @foreach ($iniciativas as $iniciativa)
                                    @if ($iniciativa->id == $verificacion->iniciativa_id)
                                        {!! $iniciativa->objetive !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>{!! $verificacion->name !!}</td>
                            <td><a href="{!! action('Root\VerificacionController@destroyVerificacion', $verificacion->id) !!}"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a></td>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>


@endsection