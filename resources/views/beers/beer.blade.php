@extends('layout.main')


@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        @if (!empty($beer))



            <h5 class="card-header">{{ $beer->name }}</h5>

            @if($userHasBeer)
                <form class="float-right m-0" method="post" action="{{ route('me.favourite.remove') }}">
                    @method('delete')
                    @csrf
                    <div class="form-row">
                        <input type="hidden" name="beerId" value="{{ $beer->id }}">

                        <button type="submit" class="btn btn-primary mb-2">Usuń z listy</button>
                    </div>
                </form>
            @else

                <form class="float-right m-0" method="post" action="{{ route('me.favourite.add') }}">
                    @csrf
                    <div class="form-row">
                        <input type="hidden" name="beerId" value="{{ $beer->id }}">

                        <button type="submit" class="btn btn-primary mb-2">Dodaj do mojej listy</button>
                    </div>
                </form>
            @endif
            <div class="card-body">
                <ul>
                    <li>ID: {{ $beer->id }}</li>
                    <li>OPIS: {{ $beer->description }}</li>
                    <li>OCENA: {{$beer->beer_rate_avg_rate}}</li>
                </ul>
            </div>
            <div><a class="btn btn-secondary btn-lg mt-2" role="button"
                    href="{{ url()->previous()}}">Powrót</a>
            </div>
        @endif
        @can('admin')
            <a class="btn btn-secondary btn-lg mt-2" role="button"
               href="{{ route('beers.edit', ['beer'=>$beer->id]) }}">Edytuj</a>
        @endcan
    </div>
@endsection
