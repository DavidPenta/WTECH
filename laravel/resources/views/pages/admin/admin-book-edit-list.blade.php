@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/style.css">
@stop
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center w-100 mt-5 mx-auto">
            <strong>{{Session::get('success')}}</strong>
        </div>
    @endif
    @if (Session::has('fail'))
        <div class="alert alert-danger text-center w-100 mt-5 mx-auto">
            <strong>{{Session::get('fail')}}</strong>
        </div>
    @endif

    <div class="container">
        <nav class="row">
            <div class="col-6 ps-4">
                <a href="/admin-book-add" type="button" class="btn btn-light btn-xl mt-4 rounded-extra">
                    Pridanie knihy
                </a>
            </div>
            <div class="col-6">
                <a href="/admin-book-edit-list" type="button"
                   class="btn btn-light btn-xl mt-4 rounded-extra float-end me-2" id="upravenie">
                    Upravenie kníh
                </a>
            </div>
        </nav>
        <section class="container align-middle align-middle">
            <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-4 pb-3">
                @foreach ($books as $book)
                    <article class="row bg-light rounded-extra p-2 ps-4 pe-4 mb-2">
                        <div class="col col-lg-1 col-md-2 d-flex flex-wrap align-items-center p-0 me-3">
                            <a href="{{route('product-detail', ['product-id' => $book->id])}}">
                            <img
                                src="{{ $images->whereIn('product_id', $book->id)->whereIn('type', 'main')->first()->path  ?? '/images/book_covers/error.png'  }}"
                                class="img-fluid book-cover" alt="Book cover">
                            </a>
                        </div>
                        <div class="col-4 d-flex flex-column me-3">
                            <h4 class="book-overflow pt-2"
                                title="{{ $book->name }}">{{ $book->name }}</h4>
                            <h6 class="book-overflow pt-2 pb-3"
                                title="{{ $book->author }}">{{ $book->author }}</h6>
                        </div>
                        <div class="col-3">
                            <a type="button" href="{{ route('editBook', $book->id) }}" class="btn btn-success btn-xl mt-4 mb-4 rounded-extra float-end" id="edit">
                                Upraviť
                            </a>
                        </div>
                        <div class="col-3">
                            <form class="closePart" action="{{ route('deleteBook',$book->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit"
                                        class="float-end btn btn-danger btn-xl mt-4 mb-4 rounded-extra float-end"
                                        id="delete">
                                    Odstániť
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
@stop
