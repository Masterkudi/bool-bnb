@extends('layouts.public')

@section('contents')
    <div class="card box-shadow mt-0">
        <div class="card-body d-flex flex-column gap-3 py-3">

            {{-- Header --}}
            <div class="container overflow-hidden">
                <div class="d-inline-block text-gradient">
                    <h1>Sponsorizzazione</h1>
                    <h2 class="ellipsis mw-100">{{ $apartment->name }}</h2>
                </div>
                <hr class="m-0">
            </div>

            <div class="container">
                @if ($apartment->sponsors()->where('valid', true)->count() > 0)
                    Hai gia una sponsorizzazione attiva con scadenza:
                    <div>
                        <span>
                            {{ $apartmentSponsor->end_date->format('d/m/y') }}
                        </span>
                        Alle ore: <span>{{ $apartmentSponsor->end_date->format('H:i') }}</span>
                    </div>
                @else
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore suscipit quis fuga veniam aliquam
                        facere esse fugiat voluptas perferendis sapiente ab assumenda neque, accusamus mollitia commodi
                        placeat necessitatibus, inventore libero?</p>
                @endif
            </div>

            <div class="container">
                <form id="payment-form" action="{{ route('admin.process_payment') }}" method="post"
                    class="col-12 col-lg-6 mx-auto">
                    @csrf
                    <div class="card mb-3" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="sponsor_id"
                                    style="font-weight: bold; font-size: 20px; padding-bottom: 1em">Scegli un
                                    pacchetto:</label><br>
                                <div class="row row-cols-1 row-cols-sm-3">
                                    @foreach ($sponsors as $sponsor)
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sponsor_id"
                                                    id="sponsor_{{ $sponsor->id }}" value="{{ $sponsor->id }}" required>
                                                <label class="form-check-label" for="sponsor_{{ $sponsor->id }}">
                                                    <h3>{{ $sponsor->name }}</h3>
                                                    <h6>Prezzo: {{ $sponsor->price }}€</h6>
                                                    <h6>Durata:
                                                        {{ $sponsor->duration }}
                                                        ore</h6>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Errore --}}
                                @error('sponsor_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <select name="apartment_id" id="apartment_id" class="form-control" required
                                    style="display: none">
                                    @foreach ($apartments as $apartment)
                                        <option value="{{ $apartment->id }}">
                                            {{ $apartment->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('apartment_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div id="dropin-wrapper" class="mt-3">
                                <div id="checkout-message"></div>
                                <div id="dropin-container"></div>
                                <input id="nonce" name="payment_method_nonce" type="hidden" required />
                                <button id="submit-button" class="styled-btn">Paga</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        var button = document.getElementById('submit-button');
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        var paymentInstance;

        braintree.dropin.create({
            authorization: client_token,
            container: '#dropin-container'
        }, function(createErr, instance) {
            if (createErr) {
                console.error(createErr);
                return;
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    console.log(payload.nonce)
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });

            //paymentInstance = instance;
        });
    </script>
@endsection

<style>
    .button {
        cursor: pointer;
        font-weight: 500;
        left: 3px;
        line-height: inherit;
        position: relative;
        text-decoration: none;
        text-align: center;
        border-style: solid;
        border-width: 1px;
        border-radius: 3px;
        -webkit-appearance: none;
        -moz-appearance: none;
        display: inline-block;
    }

    .button--small {
        padding: 10px 20px;
        font-size: 0.875rem;
    }

    .button--green {
        outline: none;
        background-color: #64d18a;
        border-color: #64d18a;
        color: white;
        transition: all 200ms ease;
    }

    .button--green:hover {
        background-color: #8bdda8;
        color: white;
    }
</style>
