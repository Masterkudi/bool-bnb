@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row">
            <div class="row cols-4 d-flex justify-content-center">
                @foreach ($apartments as $apartment)
                    <div class="col p-2">
                        <div class="card rounded-0" style="w">

                            <div class="card">
                                <div class="row mt-2 d-flex ">
                                    <div class="col">
                                        <a href="{{ route('admin.apartments.create', $apartment->id) }}"><button
                                                class="btn btn-primary">Aggiungi</button></a>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('admin.apartments.edit', $apartment->id) }}"><button
                                                class="btn btn-primary">Modifica</button></a>
                                    </div>
                                </div>

                                <div class="series">
                                    <a href="/admin/apartments/{{ $apartment->id }}">
                                        <h1>{{ $apartment['name'] }}</h1>
                                    </a>

                                </div>

                            </div>


                            <div class="card-image p-0 rounded-3">
                                <img src="" class="card-img-top rounded-0" alt="">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="card-title p-2"><strong>{{ $apartment->name }}</strong></h5>
                                    <span class="text-decoration-underline">{{ $apartment->address }}</span>
                                </div>

                                <p class="card-text hidden-on-hover"></p>
                                <p class="card-text instructions"></p>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container py-5 mx-auto d-flex justify-content-center">
            <a href="/" class="btn btn-primary btn-lg" type="button">Torna in Home</a>
            <a href="{{ route('admin.apartments.create') }}"><button class="btn btn-primary btn-lg mx-1">Nuovo appartamento</button></a>
        </div>
    </div>
@endsection
