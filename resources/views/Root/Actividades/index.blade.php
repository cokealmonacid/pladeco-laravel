@extends('root')
@section('title', 'Actividades')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Actividades </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($actividades->isEmpty())
                <p> No existen Actividades.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Iniciativa</th>
                        <th>Actividad</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($actividades as $actividad)
                        <tr>
                            <td>{!! $actividad->id !!}</td>
                            <td>
                                @foreach ($iniciativas as $iniciativa)
                                    @if ($iniciativa->id == $actividad->iniciativa_id)
                                        {!! $iniciativa->objetive !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>{!! $actividad->name !!}</td>
                            <td><a href="{!! action('Root\ActividadController@destroyActividad', $actividad->id) !!}"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a></td>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>


@endsection