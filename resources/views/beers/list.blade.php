@extends('layout.main')

@section('content')



    <div class="headAsk">

        <form class="form-inline" action="{{ route('beers.list') }}">
            <div class="form-row">
                <label class="my-1 mr-2" for="phrase">Szukana fraza</label>
                <div class="col">
                    <input type="text" class="form-control" name="phrase" placeholder="" value="{{ $phrase ?? ''}}">
                </div>

            </div>

            @php $style = $style ?? ''; @endphp


            <div class="col-auto">
                <select class="custom-select mr-sm-2" name="style">
                    <option @if($style == 'all') selected @endif value="all"> Wszystkie</option>
                    @foreach($allStyles ?? [] as $oneStyle)
                        <option @if($style == $oneStyle['id']) selected
                                @endif value="{{ $oneStyle['id'] }}">{{ $oneStyle['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-secondary" type="submit"> Szukaj</button>

        </form>

    </div>

    <div class="beerContainer">
        @foreach($beers ?? [] as $beer)
            <div class="beerElementBlock">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="/img/defaultBeer.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $beer->name}}</h5>
                        <p class="card-text">{{ $beer->beerStyle->name}}</p>
                        <div>OCENA: {{ $beer->score}}</div>
                        <a class="btn btn-secondary btn-lg mt-2" role="button"
                           href="{{ route('beers.show', ['beer'=>$beer->id]) }}">Sprawdź</a>
                        <a class="btn btn-secondary btn-lg mt-2" role="button"
                           href="{{ route('beers.delete', ['beer'=>$beer->id]) }}">Usuń</a>
                    </div>
                </div>
            </div>
    @endforeach

    </div>
    <div class="paginator">
        {{ $beers->links() }}
    </div>





@endsection
