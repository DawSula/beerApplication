@extends('layout.main')

@section('content')
    <div class="card mt-3">
        <h5 class="card-header"></h5>
        <div class="card-body">

{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}

            <form action="{{ route('beers.addBeer') }}" method="post" enctype="multipart/form-data">
            @csrf


                <div class="form-group">
                    <label for="name">Nazwa</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value= "{{ old('name') ?? ""}}"
                    />
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Opis</label>
                    <input
                        type="description"
                        class="form-control"
                        id="description"
                        name="description"
                        value="{{ old('description') ?? "" }}">


                </div>

                <div class="form-group">
                    <select class="custom-select mr-sm-2" name="style">
                        <option value="" selected disabled>GATUNEK</option>
                        @foreach($allStyles ?? [] as $oneStyle)
                            <option value="{{ $oneStyle['id'] }}">{{ $oneStyle['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Wybierz obraz</label>
                    <input
                        type="file"
                        class="form-control-file"
                        id="image"
                        name="image"
                        value=""
                    />
                    @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>




                <button type="submit" class="btn btn-secondary">Zapisz dane</button>
                <a href="{{ route('beers.list') }}" class="btn btn-secondary">Anuluj</a>
            </form>
        </div>
    </div>
@endsection
