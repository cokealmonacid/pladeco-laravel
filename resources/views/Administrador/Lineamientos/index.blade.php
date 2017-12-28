@extends('administrador')
@section('title', 'Lineamientos')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Lineamientos </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($lineamientos->isEmpty())
                <p> No existen lineamientos.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Lineamiento</th>
                        <th>Encargado</th>
                        <th>E-mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lineamientos as $lineamiento)
                        <tr>
                            <td>
                                <a href="{!! action('Administrador\AdministradorController@showLineamiento', $lineamiento->id) !!}">{!! $lineamiento->name !!} </a>
                            </td>
                            <td>
                                @foreach ($users as $user)
                                    @if ($lineamiento->user_id === $user->id)
                                        <p>{!! $user->name !!}</p>
                                    @endif    
                                @endforeach
                            </td>
                            <td>
                                @foreach ($users as $user)
                                    @if ($lineamiento->user_id === $user->id)
                                        <p>{!! $user->email !!}</p>
                                    @endif    
                                @endforeach
                            </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>


@endsection