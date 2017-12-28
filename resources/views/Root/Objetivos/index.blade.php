@extends('root')
@section('title', 'Objetivos')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Objetivos </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($objetivos->isEmpty())
                <p> No existen objetivos.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Lineamiento</th>
                        <th>Objetivo</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objetivos as $objetivo)
                        <tr>
                            <td>{!! $objetivo->id !!}</td>
                            <td>
                            @foreach($lineamientos as $lineamiento)
                                @if ($lineamiento->id === $objetivo->lineamiento_id)
                                    <a href="{!! action('Root\ObjetivoController@editObjetivo', $objetivo->id) !!}">{!! $lineamiento->name !!} </a>
                                @endif
                            @endforeach
                            </td>
                            <td>{!! $objetivo->description !!}</td>
                            <td><a href="{!! action('Root\ObjetivoController@destroyObjetivo', $objetivo->id) !!}"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a></td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>


@endsection