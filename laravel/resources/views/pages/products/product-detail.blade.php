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
                <span class="d-block fs-2 mt-3 text-black">{{ $bookData->authorName }}</span>
                <span class="d-block fs-4 mt-3 text-black">{{ $bookData->publisherName }}</span>
                <span class="d-block fs-4 mt-3 text-black">
                    @if ($bookData->pageCount == 1)
                        {{ $bookData->pageCount }} strana
                    @elseif ($bookData->pageCount < 5)
                        {{ $bookData->pageCount }} strany
                    @else
                        {{ $bookData->pageCount }} strán
                    @endif
                </span>
                <span class="d-block fs-6 mt-5 text-black">{{ $bookData->description }}</span>
                <span class="d-block fs-1 mt-5 text-success text-black"><b>{{ number_format((float)$bookData->price, 2, '.', '') }}€</b></span>
            </div>
        </div>
        <div class="row">
            <div class="container col-12 col-md-6 align-left text-center">
                <button type="button" class="btn btn-outline-danger btn-xxxl rounded-extra align-middle mt-md-5">
                    <img src="../../images/heart.svg" width="32" alt="Add to favorites">
                    <span class="ms-2 align-middle">Pridať medzi obľúbené</span>
                </button>
            </div>
            <div class="container col-12 col-md-6 align-right text-center">
                <button type="button" class="btn btn-xxl btn-success btn-block rounded-extra mt-5 align-middle">
                    <img src="../../images/basket/basket-light.svg" width="32" alt="Go to cart">
                    <span class="ms-2 align-middle">Vložiť do košíka</span>
                </button>
            </div>
        </div>
    </div>
</div>
@stop
