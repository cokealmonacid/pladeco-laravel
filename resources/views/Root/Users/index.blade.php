@extends('root')
@section('title', 'Usuarios')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Usuarios </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($users->isEmpty())
                <p> There is no user.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Creado el</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{!! $user->id !!}</td>
                            <td>
                                <a href="{!! action('Root\RootController@editUsers', $user->id) !!}">{!! $user->name !!} </a>
                            </td>
                            <td>{!! $user->email !!}</td>
                            <td>
                                @foreach ($selectedRoles as $selectedRole)
                                    @if ($selectedRole->user_id === $user->id)
                                        @foreach ($roles as $role)
                                            @if ($selectedRole->role_id === $role->id)
                                                <p>{!! $role->name !!}</p>
                                            @endif
                                        @endforeach
                                    @endif    
                                @endforeach
                            </td>
                            <td>{!! $user->created_at !!}</td>
                            <td><a href="{!! action('Root\RootController@destroyUsers', $user->id) !!}"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a>
                            </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>


@endsection