@extends('layout.main')


@section('content')
    <div class="card">
        @if (!empty($beer))
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <h5 class="card-header">{{ $beer->name }}</h5>

            <form class="float-right m-0" method="post" action="{{ route('me.favourite.add') }}">
                @csrf
                <div class="form-row">
                    <input type="hidden" name="beerId" value="{{ $beer->id }}">

                    <button type="submit" class="btn btn-primary mb-2">Dodaj do mojej listy</button>
                </div>
            </form>

            <div class="card-body">
                <ul>
                    <li>ID: {{ $beer->id }}</li>
                    <li>OPIS: {{ $beer->description }}</li>
                </ul>
            </div>


        @endif
    </div>
@endsection
