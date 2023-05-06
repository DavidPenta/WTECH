@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/product-detail-style.css">
@stop
@section('content')
<div class="container">
    <div class="container align-middle pt-5 pb-5 bg-white shadow-sm rounded-extra mt-5 mb-5">
        <div class="row">
            <div class="d-flex container col-12 col-md-6 align-center align-md-left text-center p-3 ratio-3-4 flex-wrap align-items-center">
                <img id="book-image-large" class="img-fluid d-block mx-auto mb-auto w-75" src="../../images/book_covers/book.png"
                     alt="Book cover">
            </div>
            <div class="container col-12 col-md-6 mb-5 px-3 ps-md-2 pe-md-3 align-right text-center text-md-start">
                <h1 class="d-block mt-4">{{ $bookData->name }}</h1>
                <span class="d-block fs-2 mt-3 text-black">{{ $bookData->author }}</span>
                <span class="d-block fs-4 mt-3 text-black">{{ $bookData->publisher }}</span>
                <span class="d-block fs-4 mt-3 text-black">
                    @if ($bookData->num_of_pages == 1)
                        {{ $bookData->num_of_pages }} strana
                    @elseif ($bookData->num_of_pages < 5)
                        {{ $bookData->num_of_pages }} strany
                    @else
                        {{ $bookData->num_of_pages }} strán
                    @endif
                </span>
                <span class="d-block fs-6 mt-5 pe-0 pe-md-5 text-black">{{ $bookData->description }}</span>
                <span class="d-block fs-1 mt-5 text-success text-black"><b>{{ number_format((float)$bookData->price, 2, '.', '') }}€</b></span>
            </div>
        </div>
        <div class="row">
            <section class="container col-12 col-md-6 align-left text-center">
                <form method="POST" action="{{ route('product-detail-post', ['product-id' => $bookData->id, 'post-action' => 'favorite']) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-xxxl rounded-extra align-middle mt-md-5 {{ $isFavorite ? 'active' : '' }}" >
                        <img src="../../images/heart.svg" width="32" alt="Add to favorites">
                        <span class="ms-2 align-middle">{{ $isFavorite ? 'Odobrať z obľúbených' : 'Pridať medzi obľúbené' }}</span>
                    </button>
                </form>
            </section>
            <section class="container col-12 col-md-6 align-right text-center">
                <form method="POST" action="{{ route('product-detail-post', ['product-id' => $bookData->id, 'post-action' => 'addToCart']) }}">
                    @csrf
                    <button type="submit" class="btn btn-xxl btn-success btn-block rounded-extra mt-5 align-middle">
                        <img src="../../images/basket/basket-light.svg" width="32" alt="Go to cart">
                        <span class="ms-2 align-middle">Vložiť do košíka</span>
                    </button>
                </form>
            </section>
        </div>
    </div>
</div>
@stop
