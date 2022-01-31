@extends('layout.main')

@section('content')



    <div class="headAsk">
        <div>
            <form class="form-inline" action="{{ route('beers.list') }}">
                <div class="form-row">
                    <label class="my-1 mr-2" for="phrase">Szukana fraza</label>
                    <div class="col">
                        <input type="text" class="form-control" name="phrase" placeholder="" value="{{ $phrase ?? ''}}">
                    </div>

                </div>

            @php $style = $style ?? ''; @endphp
        </div>
        <div class="blockPhrase">
            <div class="col-auto">
                <select class="custom-select mr-sm-2" name="style">
                    <option @if($style == 'all') selected @endif value="all"> Wszystkie</option>
                    @foreach($allStyles ?? [] as $oneStyle)
                        <option @if($style == $oneStyle['id']) selected
                                @endif value="{{ $oneStyle['id'] }}">{{ $oneStyle['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button class="btn btn-secondary" type="submit"> Szukaj</button>
            </div>


            </form>
        </div>
    </div>




    <div class="beerContainer">
        @foreach($beers ?? [] as $beer)

            <div class="beerElementBlock">
                <div class="card" style="width: 18rem;">
                    <div class="image-height">
                        @if($beer->image)
                            <img src="{{ Storage::disk('s3')->temporaryUrl($beer->image, '+2 minutes') }}"
                                 class="card-img-top">
                        @else
                            <img class="card-img-top" src="/img/defaultBeer.png" alt="Card image cap">
                        @endif
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $beer->name}}</h5>
                        <p class="card-text">{{ $beer->beerStyle->name}}</p>

                        @if(!empty($beer->beer_rate_avg_rate))
                            @php $rate = $beer->beer_rate_avg_rate @endphp
                            <p class="card-text">OCENA: {{ number_format((float)$rate,1)}} </p>
                            <p class="card-text mt-1"> Łącznie: {{($beer->beer_rate_count)}} </p>

                        @else
                            <p class="card-text">BRAK OCEN</p>
                            <p>-</p>
                        @endif

                        <div class="mb-4">
                            <form class="form-inline" method="post" action="{{ route('me.rate') }}">
                                @csrf
                                <input type="hidden" name="beerId" value="{{ $beer->id }}">
                                <div>
                                    <select class="custom-select mr-sm-2" name="rate">
                                        <option selected disabled> Wybierz ocenę</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <button type="submit" class="btn btn-secondary rateButton">
                                        Oceń
                                    </button>
                                </div>
                            </form>
                        </div>

                        <a class="btn btn-secondary btn-lg mt-2" role="button"
                           href="{{ route('beers.show', ['beer'=>$beer->id]) }}">Sprawdź</a>
                        @can('admin')
                            <button type="button" class="btn btn-danger btn-lg mt-2" role="button" data-toggle="modal"
                                    data-target="#deleteModal">
                                Usuń
                            </button>

                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $beer->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Czy na pewno chcesz usunąć wybrane piwo
                                        </div>
                                        <div class="modal-footer">

                                            <form method="post" action="{{ route('beers.delete') }}">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" name="beerId" value="{{ $beer->id }}">
                                                <button type="submit" class="btn btn-danger">Tak</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Powrót
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan


                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="paginator">
        {{ $beers->links() }}
    </div>





@endsection
