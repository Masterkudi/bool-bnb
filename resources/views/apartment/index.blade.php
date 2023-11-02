@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row">
        @foreach ($apartments as $apartment)
            <div class="card up rounded-0">
                <div class="card sub border-0 rounded-0">
                    <div class="card-image">
                        <img src="" class="card-img-top rounded-0" alt="">
                    </div>
                    <div class="card-body w-100">
                        <div class="row">
                            <div class="col-9 d-flex align-items-center">
                                <h5 class="card-title p-0"><strong>{{ $apartment->name }}</strong></h5>
                            </div>
                            <div class="col-3 d-flex align-items-start">
                                <span class="text-decoration-underline">{{ $apartment->address }}</span>
                            </div>
                        </div>

                        <p class="card-text hidden-on-hover"></p>
                        <p class="card-text instructions"></p>
                    </div>

                </div>
            </div>
        @endforeach
        
    </div>
@endsection
