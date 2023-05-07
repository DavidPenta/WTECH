@extends('layouts.default')
@php
    $nextCategoryOrder = $categoryOrder;
@endphp
@section('head')
    <link rel="stylesheet" href="/styles/category-style.css">
@stop
@section('content')
<div class="container">
    <section class="container align-middle pt-3 pb-3 bg-white shadow-sm rounded-extra mt-5">
        <img class="img-fluid rounded-extra" alt="Background image of books"
             srcset="../../images/banner/banner-420w.jpg 420w,
                     ../../images/banner/banner-800w.jpg 800w,
                     ../../images/banner/banner-1920w.jpg 1920w"
             src="../../images/banner/banner-1920w.jpg"
        />
    </section>
    <div class="row">
        <aside class="col-12 col-lg-3 mb-md-5 pb-4">
            <form method="get" class="align-middle p-3 p-lg-5 bg-white shadow-sm rounded-extra mt-4">
                <h3 class="col-12 pb-3 ps-4">Zoradiť produkty:</h3>
                <section class="col-12 text-left text-md-start">
                    <input type="hidden" name="search" value="{{ $search }}" />
                    <input type="hidden" name="categoryName" value="{{ $category }}" />
                    <input type="hidden" name="page" value="{{ $pageNumber }}" />
                    <input type="hidden" name="min-price" value="{{ $minPrice }}" />
                    <input type="hidden" name="max-price" value="{{ $maxPrice }}" />
                    <input type="hidden" name="min-pages" value="{{ $minPages }}" />
                    <input type="hidden" name="max-pages" value="{{ $maxPages }}" />
                    <input type="hidden" name="language" value="{{ $language }}" />
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-new">
                        <input class="form-check-input me-2" type="radio" id="order-new" name="order"
                               value="new" @checked($categoryOrder == 'new')>
                        Od najnovšieho</label>
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-old">
                        <input class="form-check-input me-2" type="radio" id="order-old" name="order"
                               value="old" @checked($categoryOrder == 'old')>
                        Od najstaršieho</label>
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-cheap">
                        <input class="form-check-input me-2" type="radio" id="order-cheap" name="order"
                               value="cheap" @checked($categoryOrder == 'cheap')>
                        Od najlacnejšieho</label>
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-expensive">
                        <input class="form-check-input me-2" type="radio" id="order-expensive" name="order"
                               value="expensive" @checked($categoryOrder == 'expensive')>
                        Od najdrahšieho</label>
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-short">
                        <input class="form-check-input me-2" type="radio" id="order-short" name="order"
                               value="short" @checked($categoryOrder == 'short')>
                        Od najkratšieho</label>
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-long">
                        <input class="form-check-input me-2" type="radio" id="order-long" name="order"
                               value="long" @checked($categoryOrder == 'long')>
                        Od najdlhšieho</label>
                    <section class="col-12 text-center d-grid mt-3">
                        <button type="submit" class="btn btn-lg btn-success btn-block rounded-extra mt-4 mx-5 mx-md-2">
                            Zoradiť
                        </button>
                    </section>
                </section>
            </form>

            <form method="get" class="align-middle p-3 p-lg-5 bg-white shadow-sm rounded-extra mt-4">
                <input type="hidden" name="search" value="{{ $search }}" />    
                <input type="hidden" name="categoryName" value="{{ $category }}" />
                <input type="hidden" name="page" value="{{ $pageNumber }}" />
                <input type="hidden" name="order" value="{{ $categoryOrder }}" />
                <h3 class="col-12 pb-3 ps-4">Filtrovať produkty:</h3>
                <h4 class="col-12 mt-4">Cena:</h4>
                <div class="row">
                    <section class="col-lg-12 col-sm-6 col-xs-12 text-center text-md-start">
                        <label for="min-price"><span class="mt-3 h6">Minimálna cena:</span></label>
                        <input name="min-price" class="form-control" id="min-price" type="number" min="0" max="10000" step="1" value="{{ $minPrice }}">
                    </section>
                    <section class="col-lg-12 col-sm-6 col-xs-12 text-center text-md-start">
                        <label for="max-price"><span class="mt-3 h6">Maximálna cena:</span></label>
                        <input name="max-price" class="form-control" id="max-price" type="number" min="0" max="10000" step="1" value="{{ $maxPrice }}">
                    </section>
                </div>
                <h4 class="col-12 mt-4">Počet strán:</h4>
                <div class="row">
                <section class="col-lg-12 col-sm-6 col-xs-12 text-center text-md-start">
                    <label for="min-pages"><span class="mt-3 h6">Minimálny počet strán:</span></label>
                    <input name="min-pages" class="form-control" id="min-pages" type="number" min="0" max="10000" step="1" value="{{ $minPages }}">
                </section>
                <section class="col-lg-12 col-sm-6 col-xs-12 text-center text-md-start">
                    <label for="max-pages"><span class="mt-3 h6">Maximálny počet strán:</span></label>
                    <input name="max-pages" class="form-control" id="max-pages" type="number" min="0" max="10000" step="1" value="{{ $maxPages }}">
                </section>
                </div>
                <label for="language" class="col-12 mt-4 h4">Jazyk:</label>
                <section class="col-12 text-center text-md-start">
                    <select name="language" id="language" class="form-select">
                        <option value="all" @selected($language == 'all')>Všetky</option>
                        <option value="sk" @selected($language == 'sk')>Slovenský</option>
                        <option value="en" @selected($language == 'en')>Anglický</option>
                        <option value="cz" @selected($language == 'cz')>Český</option>
                        <option value="de" @selected($language == 'de')>Nemecký</option>
                    </select>
                </section>
                <div class="col-12 text-center d-grid mt-3">
                    <button class="btn btn-lg btn-success btn-block rounded-extra mt-4 mx-5 mx-md-2">Použiť filter
                    </button>
                </div>
            </form>
        </aside>
        <main class="col-12 col-lg-9 mb-5">
            <article>
                <div class="row align-middle pt-3 bg-white shadow-sm rounded-extra mt-4 mb-5">
                    <h1 class="col-12 pb-3 ps-5 pt-3" id="category-title">{{ $categoryName }}</h1>
                    @foreach ($bookList as $book)
                        <div class="col-12 col-md-6 p-2">
                            <article class="bg-light shadow-sm rounded-extra p-2 ms-2 me-2">
                                <a class="text-decoration-none text-black" href="{{route('product-detail', ['product-id' => $book->id])}}">
                                    <section class="p-1">
                                        <h3 data-bs-toggle="tooltip" title="Názov knihy" class="offset-left text-truncate">
                                            {{ $book->name }}
                                        </h3>
                                        <h4 data-bs-toggle="tooltip" title="Meno autora" class="offset-left text-truncate">
                                            {{ $book->author }}
                                        </h4>
                                    </section>
                                    <section class="row p-3">
                                        <section class="d-flex container col-4 align-left text-center">
                                            <img class="img-fluid mb-auto" src="{{ $book->mainImage->path ?? '/images/book_covers/error.png' }}"
                                                 alt="Book cover">
                                        </section>
                                        <section class="d-flex container col-8 align-right">
                                            <div class="row">
                                                <section class="d-flex container align-left book-description">
                                                    <p class="text-wrap text-break line-clamp">
                                                        {{ $book->description }}
                                                    </p>
                                                </section>
                                                <div class="d-flex container align-left align-items-end">
                                                    <div class="d-flex container col-6">
                                                        <span class="fs-4 mt-3 text-black"><b>{{ number_format((float)$book->price, 2, '.', '') }}€</b></span>
                                                    </div>
                                                    <div class="d-flex container col-6 d-flex flex-row-reverse">
                                                        <button class="btn btn-success rounded-extra">
                                                            <img class="img-fluid d-block mx-auto"
                                                                 src="../../images/basket/basket-light.svg" width="30"
                                                                 alt="Add to cart">
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </section>
                                </a>
                            </article>
                        </div>
                    @endforeach
                    <section class="col-12 d-flex container btn-group justify-content-center align-items-center">
                        @if ($pageNumber > 2)
                            <a id="page-anchor-0" href="{{route('category', ['search' => $search, 'categoryName' => $category, 'page' => $pageNumber - 2, 'order' => $categoryOrder, 'minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'minPages' => $minPages, 'maxPages' => $maxPages, 'language' => $language])}}">
                                <button class="btn btn-outline-secondary m-2" id="page-label-0">{{ $pageNumber - 2 }}</button>
                            </a>
                        @endif
                        @if ($pageNumber > 1)
                            <a id="page-anchor-1" href="{{route('category', ['search' => $search, 'categoryName' => $category, 'page' => $pageNumber - 1, 'order' => $categoryOrder, 'minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'minPages' => $minPages, 'maxPages' => $maxPages, 'language' => $language])}}">
                                <button class="btn btn-outline-secondary m-2" id="page-label-1">{{ $pageNumber - 1 }}</button>
                            </a>
                        @endif
                        <a id="page-anchor-2" href="">
                            <button class="btn btn-outline-primary btn-lg m-2" id="page-label-2">{{ $pageNumber }}</button>
                        </a>
                        @if ($pageNumber < $maxPageNumber)
                            <a id="page-anchor-3" href="{{route('category', ['search' => $search, 'categoryName' => $category, 'page' => $pageNumber + 1, 'order' => $categoryOrder, 'minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'minPages' => $minPages, 'maxPages' => $maxPages, 'language' => $language])}}">
                                <button class="btn btn-outline-secondary m-2" id="page-label-3">{{ $pageNumber + 1 }}</button>
                            </a>
                        @endif
                        @if ($pageNumber < $maxPageNumber - 1)
                            <a id="page-anchor-4" href="{{route('category', ['search' => $search, 'categoryName' => $category, 'page' => $pageNumber + 2, 'order' => $categoryOrder, 'minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'minPages' => $minPages, 'maxPages' => $maxPages, 'language' => $language])}}">
                                <button class="btn btn-outline-secondary m-2" id="page-label-4">{{ $pageNumber + 2 }}</button>
                            </a>
                        @endif
                    </section>
                </div>
            </article>
        </main>
    </div>
</div>
@stop
