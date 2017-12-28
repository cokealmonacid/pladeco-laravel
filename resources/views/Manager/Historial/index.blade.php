@extends('manager')
@section('title', 'Historial')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Historial </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($historias->isEmpty())
                <p> No existe Historial.</p>
            @else
                <table class="table" id="historial">
                    <thead>
                    <tr>
                        <th>Acción</th>
                        <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($historias as $historia)
                        <tr>
                            @if($historia->type === 'iniciativa')
                            <td id="historial-iniciativa">
                            @endif
                            @if($historia->type === 'actividad')
                            <td id="historial-actividad">
                            @endif
                            @if($historia->type === 'verificacion')
                            <td id="historial-verificacion">
                            @endif
                            @if($historia->type === 'indicador')
                            <td id="historial-indicador">
                            @endif
                                <p>{!! $historia->accion !!}</p>
                            </td>
                            <td>
                               <p>{!! $historia->created_at->format('d-m-Y') !!}</p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>


@endsection