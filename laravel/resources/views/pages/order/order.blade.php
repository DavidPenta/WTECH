@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/style.css">
    <script src="/scripts/order-script.js"></script>
@stop
@section('content')
<div class="container align-middle align-middle">
    <section class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-5 mb-3 pb-3">
        <h3 class="text-center">Dodacie údaje</h3>
        <form class="row g-3 m-2" action="{{route('order.complete')}}" id="order" method="post">
        @csrf
        @if (is_null($value))
            <div class="col-12 col-md-6">
                <label class="ps-3" for="name">Meno</label>
                <input required id="name" name="name" type="text" class="form-control" maxlength="64" value="{{ $order->user->first_name }}">
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="surname">Priezvisko</label>
                <input required id="surname" name="surname" type="text" class="form-control" maxlength="64" value="{{ $order->user->last_name }}">
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="email">Email</label>
                <input required id="email" name="email" type="email" class="form-control" maxlength="254" value="{{ $order->user->email }}">
                <span class="text-danger"> @error('email') {{$message}} @enderror</span>
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="phone">Telefónne číslo</label>
                <input required id="phone" name="phone" type="text" class="form-control" maxlength="15" minlength="10" value="{{ $order->user->phone_num }}">
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-9 pe-0">
                        <label class="ps-3" for="street">Ulica</label>
                        <input required id="street" name="street" type="text" class="form-control" maxlength="128" value="{{ is_null($order->address) ? '' : $order->address->address_street }}">
                    </div>
                    <div class="col-3">
                        <label class="ps-3" for="street-number">Číslo</label>
                        <input required id="street-number" name="streetNumber" type="text" class="form-control" maxlength="16" value="{{ is_null($order->address) ? '' : $order->address->address_number }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="city">Mesto</label>
                <input required id="city" name="city" type="text" class="form-control" maxlength="128" value="{{ is_null($order->address) ? '' : $order->address->address_city }}">
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="postcode">PSČ</label>
                <input required id="postcode" name="postcode" type="text" class="form-control pe-5" maxlength="10" value="{{ is_null($order->address) ? '' : $order->address->address_postcode }}">
            </div>
            <div class="row mt-5 mb-5 ms-3">
                <div class="col-md-6 col-12 mb-4 col-md-0">
                    <h2 class="text pb-md-2">Spôsob doručenia</h2>
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="deliveryType" id="deliveryType1" value="Doručenie na adresu" onclick="check({{ $order->value }}, 3.99)">
                        <label class="form-check-label" for="deliveryType1">
                            Doručenie na adresu (+3,99€)
                        </label>
                    </div>
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="deliveryType" id="deliveryType2" value="Vyzdvihnutie na predajni" onclick="check({{ $order->value }}, 0)">
                        <label class="form-check-label" for="deliveryType2">
                            Vyzdvihnutie na predajni
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h2 class="text pb-md-2">Platba</h2>
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="paymentType" id="paymentType1" value="Kartou online">
                        <label class="form-check-label" for="paymentType1">
                            Kartou online
                        </label>
                    </div>
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="paymentType" id="paymentType2" value="Na dobierku">
                        <label class="form-check-label" for="paymentType2">
                            V hotovosti
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <span id="total" class="fs-3 text-black text-end">Celková suma : {{ $order->value }}€</span>
            </div>
        @else
            <div class="col-12 col-md-6">
                <label class="ps-3" for="name">Meno</label>
                <input required id="name" name="name" type="text" class="form-control" maxlength="64" value="{{old('name')}}">
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="surname">Priezvisko</label>
                <input required id="surname" name="surname" type="text" class="form-control" maxlength="64" value="{{old('surname')}}">
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="email">Email</label>
                <input required id="email" name="email" type="email" class="form-control" maxlength="254" value="{{old('email')}}">
                <span class="text-danger"> @error('email') {{$message}} @enderror</span>
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="phone">Telefónne číslo</label>
                <input required id="phone" name="phone" type="text" class="form-control" minlength="10"  maxlength="15" value="{{old('phone')}}">
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-9 pe-0">
                        <label class="ps-3" for="street">Ulica</label>
                        <input required id="street" name="street" type="text" class="form-control" maxlength="128">
                    </div>
                    <div class="col-3">
                        <label class="ps-3" for="street-number">Číslo</label>
                        <input required id="street-number" name="streetNumber" type="text" class="form-control" maxlength="16">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="city">Mesto</label>
                <input required id="city" name="city" type="text" class="form-control" maxlength="128" value="{{old('city')}}">
            </div>
            <div class="col-12 col-md-6">
                <label class="ps-3" for="postcode">PSČ</label>
                <input required id="postcode" name="postcode" type="text" class="form-control pe-5" maxlength="10" value="{{old('postcode')}}">
            </div>
            <div class="row mt-5 mb-5 ms-3">
                <div class="col-md-6 col-12 mb-4 col-md-0">
                    <h2 class="text pb-md-2">Spôsob doručenia</h2>
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="deliveryType" id="deliveryType1" value="Doručenie na adresu" onclick="check({{ $value }}, 3.99)">
                        <label class="form-check-label" for="deliveryType1">
                            Doručenie na adresu (+3,99€)
                        </label>
                    </div>
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="deliveryType" id="deliveryType2" value="Vyzdvihnutie na predajni" onclick="check({{ $value }}, 0)">
                        <label class="form-check-label" for="deliveryType2">
                            Vyzdvihnutie na predajni
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h2 class="text pb-md-2">Platba</h2>
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="paymentType" id="paymentType1" value="Kartou online">
                        <label class="form-check-label" for="paymentType1">
                            Kartou online
                        </label>
                    </div>
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="paymentType" id="paymentType2" value="Na dobierku">
                        <label class="form-check-label" for="paymentType2">
                            V hotovosti
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <span id="total" class="fs-3 text-black text-end">Celková suma : {{ $value }}€</span>
            </div>
        @endif
        </form>
    </section>
    <section class="d-grid gap-2 d-md-block">
        <div class="d-flex justify-content-center justify-content-md-start mt-1 ms-sm-4 me-sm-4 float-start">
            <a href="/" class="btn btn-outline-success btn-xxl text-nowrap" role="button">Pokračovať v nákupe</a>
        </div>

        <div class="d-flex justify-content-center justify-content-md-end mt-1 ms-sm-4 me-sm-4 float-end">
            <button type="submit" class="btn btn-success btn-xxl" role="button" form="order">Objednať</button>
        </div>
    </section>
</div>
@stop
