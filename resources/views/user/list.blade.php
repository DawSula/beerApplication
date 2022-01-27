@extends('layout.main')



@section('content')

    <div class="beerContainer">

        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nazwa użytkownika</th>
                <th scope="col">Email</th>
                <th scope="col">Opcje</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a class="btn btn-secondary" href="{{route('admin.users.show',['userId'=>$user->id])}}">
                                Szczegóły</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>





    </div>
@endsection
{{--<table>--}}
{{--    @each('user.listRow', $users, 'userData')--}}
{{--</table>--}}


