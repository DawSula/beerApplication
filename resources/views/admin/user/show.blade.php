@extends('layout.main')

@section('title','Użytkownik')

@section('content')
<div>
    <hr/>
    <h3>Informacje o użytkowniku: </h3>
    <ul>
        <li>Id: {{$user->id}}</li>
        <li>Nazwa: {{$user->name}}</li>
    </ul>
    <div>

</div>
@endsection
