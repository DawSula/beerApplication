@extends('layout.main')

@section('content')

<div class="card marginTop-Lg">
    <div class="card-header">Statystyka ocen</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ocena</th>
                        <th>Liczba gier z oceną</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scoreStats as $statRow)
                        <tr>
                            <td>{{ $statRow->score }}</td>
                            <td>{{ $statRow->count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header">Najlepsze piwa</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Ocena</th>
                        <th>Gatunek</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bestBeers as $statRow)
                        <tr>
                            <td>{{ $statRow->name }}</td>
                            <td>{{ $statRow->score }}</td>
                            <td>{{ $statRow->beerStyle->name }}</td>
                            <td><a href="{{ route('beers.show', ['beer'=>$statRow->id]) }}">Sprawdź</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
