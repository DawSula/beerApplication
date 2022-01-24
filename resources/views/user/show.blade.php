@extends('layout.main')

@section('title','Użytkownik')



@section('content')
<div>
    <hr/>
    <h3>Informacje o użytkowniku: </h3>
    <ul>
        <li>Id: {{$user['id']}}</li>
        <li>Imię: {{$user['firstName']}}</li>
        <li>Nazwisko: {{$user['lastName']}}</li>
        <li>Miasto: {{$user['city']}}

        </li>

        <li>

            Wiek: {{$user['age']}}
            @if($user['age'] >= 18)
               <div>Osoba dorosła</div>
            @else
                <div>Nastolatek</div>
            @endif
        </li>

    </ul>
    <div>
        @isset($nick)
            Nick:xxx
        @else
            ISSET:FALSE
        @endisset
    </div>

</div>
@endsection
