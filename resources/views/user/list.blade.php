@extends('layout.main')



@section('content')


    


    <div class="beerContainer">
        @foreach($users as $user)
            <div class="beerElementBlock">
                <div>{{$loop->index}}</div>
                <div>{{$loop->iteration}}</div>
                <div>{{$user['id']}}</div>
                <div>{{$user['name']}}</div>
                <div>Link</div>
            </div>
        @endforeach
    </div>


    <hr/>
    <hr/>
    <hr/>

    halo
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Nick</th>
            <th>Opcje</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="3">EACH</td>
        </tr>
        @each('user.listRow', $users, 'userData')

        <td colspan="3">FOREACH</td>
        @foreach($users as $user)
            @include('user.listRow',['userData'=>$user])
        @endforeach

        <td colspan="3">FOR</td>
        @for($i = 0; $i<count($users); $i++)
            @include('user.listRow',['userData'=>$users[$i]])
        @endfor

        <td colspan="3">FORELSE</td>
        @forelse($users as $user)
            @include('user.listRow',['userData'=>$user])
        @empty
            <tr>
                <td colspan="3">Lista jest pusta</td>
            </tr>
        @endforelse
        <tr>
            <td colspan="3">WHILE</td>
        </tr>
        @php
            $j = 0
        @endphp
        @while($j < count($users))
            @include('user.listRow',['userData'=>$users[$j]])
            @php
                $j++
            @endphp
        @endwhile
        </tbody>
    </table>
@endsection
{{--<table>--}}
{{--    @each('user.listRow', $users, 'userData')--}}
{{--</table>--}}


