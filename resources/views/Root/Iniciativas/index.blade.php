@extends('root')
@section('title', 'Iniciativas')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Iniciativas </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($iniciativas->isEmpty())
                <p> No existen iniciativas.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Lineamiento</th>
                        <th>Componente</th>
                        <th>Cartera de Iniciativa</th>
                        <th>Objetivo</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($iniciativas as $iniciativa)
                        <tr>
                            <td>{!! $iniciativa->id !!}</td>
                            <td>
                                @foreach ($componentes as $componente)
                                    @if($componente->id === $iniciativa->componente_id)
                                        @foreach($lineamientos as $lineamiento)
                                            @if($componente->lineamiento_id === $lineamiento->id)
                                                {!! $lineamiento->name !!}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach     
                            </td>
                            <td>
                                @foreach ($componentes as $componente)
                                    @if ($componente->id === $iniciativa->componente_id)
                                        {!! $componente->name !!}
                                    @endif
                                @endforeach                                     
                            </td>
                            <td>{!! $iniciativa->cartera !!}</td>
                            <td>{!! $iniciativa->objetive !!}</td>
                            <td><a href="{!! action('Root\IniciativaController@destroyIniciativa', $iniciativa->id) !!}"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a></td>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>


@endsection