@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row">
            <div class="row cols d-flex justify-content-center">

                <div class="container py-5 mx-auto d-flex justify-content-center">
                    <a href="/" class="btn btn-primary btn-lg" type="button">Torna in Home</a>
                    <a href="{{ route('admin.apartments.create') }}"><button class="btn btn-primary btn-lg mx-1">
                            Nuovo appartamento</button></a>
                </div>
                @foreach ($apartments as $apartment)
                    <div class="col-3 p-2 m-3" style="border: .1px solid black">
                        <div class="card-image p-0 rounded-3">
                            <img src="" class="card-img-top rounded-0" alt="">
                        </div>
                        <div class="card-body h-50">
                            <div class="row d-flex">
                                <a class="text-decoration-none p-2 text-center text-black"
                                    href="/admin/apartments/{{ $apartment->id }}">{{ $apartment['name'] }}</a>
                                <span class="text-decoration-none p-2 text-center">{{ $apartment->address }}</span>
                            </div>
                        </div>
                        <div class="p-2 mt-2 d-flex justify-content-center">
                            <a href="{{ route('admin.apartments.edit', $apartment->id) }}">
                                <button class="btn btn-md m-2 btn-primary">Modifica</button></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container py-5 mx-auto d-flex justify-content-center">
            <a href="/" class="btn btn-primary btn-lg" type="button">Torna in Home</a>
            <a href="{{ route('admin.apartments.create') }}"><button class="btn btn-primary btn-lg mx-1">
                    Nuovo appartamento</button></a>
        </div>
    </div>
@endsection
