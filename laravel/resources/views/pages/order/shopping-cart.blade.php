@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/shopping-cart-style.css">
@stop
@section('content')
<div class="container align-middle">
    <section class="container align-middle bg-white shadow-sm rounded-extra mt-5 mb-3 p-4">
        <h3 class="text-center pb-3">Nákupný košík</h3>
        @if (is_null($order))
            <h4 class="text-center m-5">Váš košík je prázdny.</h4>
        @else
            @foreach ($order->orderProducts as $orderProduct)
            <article class="row bg-light rounded-extra p-2 ps-4 pe-4 mb-2">
                <div class="col-3 col-lg-1 col-md-2 d-flex flex-wrap align-items-center p-0 me-3">
                    <img src="{{ $orderProduct->product->images->where('type', '=', 'main')->first()->path }}" class="img-fluid book-cover" alt="Book cover">
                </div>
                <div class="col d-flex flex-column justify-content-between p-0 me-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="book-overflow" data-bs-toggle="tooltip" title="{{ $orderProduct->product->name }}">{{ $orderProduct->product->name }}</h4>
                            <h6 class="book-overflow" data-bs-toggle="tooltip" title="{{ $orderProduct->product->author }}">{{ $orderProduct->product->author }}</h6>
                        </div>
                        <div class="col-1 text-end p-0">
                            <button type="button" class="btn-close" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="col-5 col-sm-4 col-md-3 col-lg-2 col-xxl-1">
                            <label for="amount-input-2">Počet</label>
                            <input type="number" min="1" step="1" class="form-control amount-input" id="amount-input-1" placeholder="{{ $orderProduct->quantity }}">
                        </div>
                        <div class="col-1 align-self-end p-0">
                            <span class="fs-5 text-black float-end">{{ number_format((float)$orderProduct->product->price * $orderProduct->quantity, 2, '.', '') }}€</span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach

            <div class="row m-2 mt-4">
                <span class="fs-3 text-black text-end">{{$order->value}}€</span>
            </div>
            @endif
    </section>
    <section class="d-grid gap-2 d-md-block">
        <div class="d-flex justify-content-center justify-content-md-start mt-1 ms-sm-4 me-sm-4 float-start">
            <a href="/" class="btn btn-outline-success btn-xxl text-nowrap" role="button">Pokračovať v nákupe</a>
        </div>
        @if(!is_null($order))
        <div class="d-flex justify-content-center justify-content-md-end mt-1 ms-sm-4 me-sm-4 float-end">
            <a href="order" class="btn btn-success btn-xxl text-nowrap" role="button">Objednať</a>
        </div>
        @endif
    </section>
</div>
@stop
