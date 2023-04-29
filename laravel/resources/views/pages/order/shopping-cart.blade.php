@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/shopping-cart-style.css">
@stop
@section('content')
<div class="container align-middle">
    <section class="container align-middle bg-white shadow-sm rounded-extra mt-5 mb-3 p-4">
        <h3 class="text-center pb-3">Nákupný košík</h3>

        <article class="row bg-light rounded-extra p-2 ps-4 pe-4 mb-2">
            <div class="col-3 col-lg-1 col-md-2 d-flex flex-wrap align-items-center p-0 me-3">
                <img src="../../images/book_covers/princ.jpg" class="img-fluid book-cover" alt="Book cover">
            </div>
            <div class="col d-flex flex-column justify-content-between p-0 me-3">
                <div class="row">
                    <div class="col">
                        <h4 class="book-overflow" data-bs-toggle="tooltip" title="Malý princ">Malý princ</h4>
                        <h6 class="book-overflow" data-bs-toggle="tooltip" title="Antoine de Saint-Exupéry">Antoine de Saint-Exupéry</h6>
                    </div>
                    <div class="col-1 text-end p-0">
                        <button type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-5 col-sm-4 col-md-3 col-lg-2 col-xxl-1">
                        <label for="amount-input-1">Počet</label>
                        <input type="number" min="1" step="1" class="form-control amount-input" id="amount-input-1" placeholder="1">
                    </div>
                    <div class="col-1 align-self-end p-0">
                        <span class="fs-5 text-black float-end">5€</span>
                    </div>
                </div>
            </div>
        </article>

        <article class="row bg-light rounded-extra p-2 ps-4 pe-4 mb-2">
            <div class="col-3 col-lg-1 col-md-2 d-flex flex-wrap align-items-center p-0 me-3">
                <img src="../../images/book_covers/harry.jpg" class="img-fluid book-cover" alt="Book cover">
            </div>
            <div class="col d-flex flex-column justify-content-between p-0 me-3">
                <div class="row">
                    <div class="col">
                        <h4 class="book-overflow" data-bs-toggle="tooltip" title="Harry Potter a kameň mudrcov">Harry Potter a kameň mudrcov</h4>
                        <h6 class="book-overflow" data-bs-toggle="tooltip" title="J. K. Rowlingová">J. K. Rowlingová</h6>
                    </div>
                    <div class="col-1 text-end p-0">
                        <button type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-5 col-sm-4 col-md-3 col-lg-2 col-xxl-1">
                        <label for="amount-input-2">Počet</label>
                        <input type="number" min="1" step="1" class="form-control amount-input" id="amount-input-2" placeholder="1">
                    </div>
                    <div class="col-1 align-self-end p-0">
                        <span class="fs-5 text-black float-end">8.99€</span>
                    </div>
                </div>
            </div>
        </article>

        <article class="row bg-light rounded-extra p-2 ps-4 pe-4 mb-2">
            <div class="col-3 col-lg-1 col-md-2 d-flex flex-wrap align-items-center p-0 me-3">
                <img src="../../images/book_covers/book.png" class="img-fluid book-cover" alt="Book cover">
            </div>
            <div class="col d-flex flex-column justify-content-between p-0 me-3">
                <div class="row">
                    <div class="col">
                        <h4 class="book-overflow" data-bs-toggle="tooltip" title="Good book with a very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very looooong name">Good book with a very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very looooong name</h4>
                        <h6 class="book-overflow" data-bs-toggle="tooltip" title="Author with a very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very looong name">Author with a very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very looong name</h6>
                    </div>
                    <div class="col-1 text-end p-0">
                        <button type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-5 col-sm-4 col-md-3 col-lg-2 col-xxl-1">
                        <label for="amount-input-3">Počet</label>
                        <input type="number" min="1" step="1" class="form-control amount-input" id="amount-input-3" placeholder="1">
                    </div>
                    <div class="col-1 align-self-end p-0">
                        <span class="fs-5 text-black float-end">10€</span>
                    </div>
                </div>
            </div>
        </article>

        <div class="row m-2 mt-4">
            <span class="fs-3 text-black text-end">Celková suma : 23,99€</span>
        </div>
    </section>
    <section class="d-grid gap-2 d-md-block">
        <div class="d-flex justify-content-center justify-content-md-start mt-1 ms-sm-4 me-sm-4 float-start">
            <a href="/" class="btn btn-outline-success btn-xxl text-nowrap" role="button">Pokračovať v nákupe</a>
        </div>
        <div class="d-flex justify-content-center justify-content-md-end mt-1 ms-sm-4 me-sm-4 float-end">
            <a href="order" class="btn btn-success btn-xxl text-nowrap" role="button">Objednať</a>
        </div>
    </section>
</div>
@stop
