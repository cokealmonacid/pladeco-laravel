@extends('root')
@section('title', 'Componentes')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Componentes </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($componentes->isEmpty())
                <p> No existen componentes.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Lineamiento</th>
                        <th>Componente</th>
                        <th>Descripción</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($componentes as $componente)
                        <tr>
                            <td>{!! $componente->id !!}</td>
                            <td>
                                @foreach ($lineamientos as $lineamiento)
                                    @if ($lineamiento->id === $componente->lineamiento_id)
                                    <a href="{!! action('Root\ComponenteController@editComponente', $componente->id) !!}">{!! $lineamiento->name !!} </a>
                                    @endif
                                @endforeach     
                            </td>
                            <td>{!! $componente->name !!}</td>
                            <td>{!! $componente->objetive !!}</td>
                            <td><a href="{!! action('Root\ComponenteController@destroyComponente', $componente->id) !!}"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a></td>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>


@endsection