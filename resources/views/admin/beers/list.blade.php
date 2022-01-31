@extends('layout.main')

@section('content')




    <div class="beerContainer">
        @foreach($beers ?? [] as $beer)

            <div class="beerElementBlock">

                <div class="card" style="width: 18rem;">
                    <form method="post" action="{{ route('admin.waitingBeers.approve') }}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="beerId" value="{{ $beer->id }}">
                        <button class="add-to-list"><i class="icon-ok"></i></button>
                    </form>

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

                        <a class="btn btn-secondary btn-lg mt-2" role="button"
                           href="{{ route('beers.show', ['beer'=>$beer->id]) }}">Sprawdź</a>

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


                        {{--                        <a class="btn btn-secondary btn-lg mt-2" role="button"--}}
                        {{--                           href="{{ route('beers.delete', ['beer'=>$beer->id]) }}">Usuń</a>--}}
                    </div>
                </div>
            </div>

        @endforeach

    </div>
    <div class="paginator">
        {{ $beers->links() }}
    </div>





@endsection
