@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/style.css">
@stop
@section('content')
    <div class="container">
        <nav class="row">
            <div class="col-6 ps-4">
                <a href="/admin-book-add">
                    <button type="button" class="btn btn-light btn-xl mt-4 rounded-extra" id="pridanie">Pridanie knihy
                    </button>
                </a>
            </div>
            <div class="col-6">
                <a href="/admin-book-edit-list">
                    <button type="button" class="btn btn-light btn-xl mt-4 rounded-extra float-end me-2" id="upravenie">
                        Upravenie
                        kníh
                    </button>
                </a>
            </div>
        </nav>
        <section class="container align-middle align-middle">
            <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-4 pb-3">
                @foreach ($books as $book)
                    <article class="row bg-light rounded-extra p-2 ps-4 pe-4 mb-2">
                        <div class="col col-lg-1 col-md-2 d-flex flex-wrap align-items-center p-0 me-3">
                            <img
                                src="{{ $images->whereIn('product_id', $book->id)->whereIn('type', 'main')->first()->path  ?? '/images/book_covers/error.png'  }}"
                                class="img-fluid book-cover" alt="Book cover">
                        </div>
                        <div class="col-4 d-flex flex-column me-3">
                            <h4 class="book-overflow pt-2"
                                title="{{ $book->name }}">{{ $book->name }}</h4>
                            <h6 class="book-overflow pt-2 pb-3"
                                title="{{ $book->author }}">{{ $book->author }}</h6>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-success btn-xl mt-4 rounded-extra float-end" id="edit">
                                Upraviť
                            </button>
                        </div>
                        <div class="col-3">
                            <p>
                                <button type="button"
                                        class="float-end btn btn-danger btn-xl mt-4 rounded-extra float-end"
                                        id="delete">Odstániť
                                </button>
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
@stop
