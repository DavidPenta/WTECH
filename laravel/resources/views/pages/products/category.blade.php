@extends('layouts.default')
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
            <article class="align-middle p-3 p-lg-5 bg-white shadow-sm rounded-extra mt-4">
                <h3 class="col-12 pb-3 ps-4">Zoradiť produkty:</h3>
                <section class="col-12 text-left text-md-start">
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-cheap">
                        <input class="form-check-input me-2" type="radio" id="order-cheap" name="order"
                               value="child">
                        Od najlacnejšieho</label>
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-expensive">
                        <input class="form-check-input me-2" type="radio" id="order-expensive" name="order"
                               value="child">
                        Od najdrahšieho</label>
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-short">
                        <input class="form-check-input me-2" type="radio" id="order-short" name="order"
                               value="child">
                        Od najkratšieho</label>
                    <label class="form-check-label fs-5 col-12 ps-1" for="order-long">
                        <input class="form-check-input me-2" type="radio" id="order-long" name="order"
                               value="child">
                        Od najdlhšieho</label>
                    <section class="col-12 text-center d-grid mt-3">
                        <button class="btn btn-lg btn-success btn-block rounded-extra mt-4 mx-5 mx-md-2">Zoradiť
                        </button>
                    </section>
                </section>
            </article>

            <article class="align-middle p-3 p-lg-5 bg-white shadow-sm rounded-extra mt-4">
                <h3 class="col-12 pb-3 ps-4">Filtrovať produkty:</h3>
                <h4 class="col-12 mt-4">Cena:</h4>
                <div class="row">
                    <section class="col-lg-12 col-sm-6 col-xs-12 text-center text-md-start">
                        <label for="min_price"><span class="mt-3 h6">Minimálna cena:</span></label>
                        <input class="form-control" id="min_price" type="number" min="0" max="10000" step="1" value="0">
                    </section>
                    <section class="col-lg-12 col-sm-6 col-xs-12 text-center text-md-start">
                        <label for="max_price"><span class="mt-3 h6">Maximálna cena:</span></label>
                        <input class="form-control" id="max_price" type="number" min="0" max="10000" step="1"
                               value="10">
                    </section>
                </div>
                <h4 class="col-12 mt-4">Počet strán:</h4>
                <div class="row">
                <section class="col-lg-12 col-sm-6 col-xs-12 text-center text-md-start">
                    <label for="min_pages"><span class="mt-3 h6">Minimálny počet strán:</span></label>
                    <input class="form-control" id="min_pages" type="number" min="0" max="10000" step="1" value="1">
                </section>
                <section class="col-lg-12 col-sm-6 col-xs-12 text-center text-md-start">
                    <label for="max_pages"><span class="mt-3 h6">Maximálny počet strán:</span></label>
                    <input class="form-control" id="max_pages" type="number" min="0" max="10000" step="1"
                           value="500">
                </section>
                </div>
                <label for="language" class="col-12 mt-4 h4">Jazyk:</label>
                <section class="col-12 text-center text-md-start">
                    <select name="language" id="language" class="form-select">
                        <option value="sk">Slovenský</option>
                        <option value="en">Anglický</option>
                        <option value="cz">Český</option>
                        <option value="de">Nemecký</option>
                    </select>
                </section>
                <div class="col-12 text-center d-grid mt-3">
                    <button class="btn btn-lg btn-success btn-block rounded-extra mt-4 mx-5 mx-md-2">Použiť filter
                    </button>
                </div>
            </article>
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
                                        <h3 data-bs-toggle="tooltip" title="Názov knihy" class="offset-left text-wrap text-break">
                                            {{ $book->name }}
                                        </h3>
                                        <h4 data-bs-toggle="tooltip" title="Meno autora" class="offset-left text-wrap text-break">
                                            {{ $book->authorName }}
                                        </h4>
                                    </section>
                                    <section class="row p-3">
                                        <section class="d-flex container col-4 align-left text-center">
                                            <img class="img-fluid mb-auto" src="../../images/book_covers/book.png"
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
                        <a id="page-anchor-0" href="">
                            <button class="btn btn-outline-secondary m-2" id="page-label-0"></button>
                        </a>
                        <a id="page-anchor-1" href="">
                            <button class="btn btn-outline-secondary m-2" id="page-label-1"></button>
                        </a>
                        <a id="page-anchor-2" href="">
                            <button class="btn btn-outline-primary btn-lg m-2" id="page-label-2"></button>
                        </a>
                        <a id="page-anchor-3" href="">
                            <button class="btn btn-outline-secondary m-2" id="page-label-3"></button>
                        </a>
                        <a id="page-anchor-4" href="">
                            <button class="btn btn-outline-secondary m-2" id="page-label-4"></button>
                        </a>
                    </section>
                </div>
            </article>
        </main>
    </div>
</div>
@stop
