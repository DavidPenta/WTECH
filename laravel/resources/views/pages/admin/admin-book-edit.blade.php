@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/style.css">
@stop
@section('content')
    <div class="container">
        <nav class="row">
            <div class="col-6 ps-4">
                <a href="/admin-book-add" type="button" class="btn btn-light btn-xl mt-4 rounded-extra">
                    Pridanie knihy
                </a>
            </div>
            <div class="col-6">
                <a href="/admin-book-edit-list" type="button"
                   class="btn btn-light btn-xl mt-4 rounded-extra float-end me-2 active">
                    Upravenie kníh
                </a>
            </div>
        </nav>
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
        <section class="container align-middle align-middle">
            <form class="row g-3" method="post" action="{{route('saveEditedBook', $book->id)}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-4 pb-3">
                    <h1 class="text-center pb-3 pt-3">Upravenie knihy</h1>
                    <div class="row">
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <label class="ps-3" for="name">Názov knihy</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{$book->name}}"
                                   required/>
                            <span class="text-danger"> @error('name') {{$message}} @enderror</span>
                        </div>
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <label class="ps-3" for="author">Autor</label>
                            <input id="author" type="text" class="form-control" name="author" value="{{$book->author}}"
                                   required/>
                            <span class="text-danger"> @error('author') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <label class="ps-3" for="language">Jazyk</label>
                            <select class="form-control" id="language" name="language">
                                @foreach($languages as $language)
                                    <option value="{{$language}}"
                                        @if ($language == $book->language)
                                            selected="selected"
                                        @endif
                                    >{{$language}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger"> @error('language') {{$message}} @enderror</span>
                        </div>
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <label class="ps-3" for="publisher">Vydavateľstvo</label>
                            <select class="form-control" id="publisher" name="publisher">
                                @foreach($publishers as $publisher)
                                    <option value="{{$publisher}}"
                                        @if ($publisher == $book->publisher)
                                            selected="selected"
                                        @endif
                                            >{{$publisher}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger"> @error('publisher') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <label class="ps-3" for="category">Kategória</label>
                            <select class="form-control" id="category" name="category">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                            @if ($category->id == $book->category_id)
                                                selected="selected"
                                            @endif
                                    >{{$category->full}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger"> @error('category') {{$message}} @enderror</span>
                        </div>
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <label class="ps-3" for="price">Cena</label>
                            <input id="price" type="number" step="0.01" class="form-control" name="price"
                                   value="{{$book->price}}" required/>
                            <span class="text-danger"> @error('price') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <label class="ps-3" for="date">Dátum vydania</label>
                            <input id="date" type="date" class="form-control" name="date" value="{{$book->date}}"
                                   required/>
                            <span class="text-danger"> @error('date') {{$message}} @enderror</span>
                        </div>
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <label class="ps-3" class="ps-3" for="num_of_pages">Počet strán</label>
                            <input id="num_of_pages" type="number" class="form-control" name="num_of_pages"
                                   value="{{$book->num_of_pages}}" required/>
                            <span class="text-danger"> @error('num_of_pages') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <span class="ps-3">Hlavný obrázok</span>
                            <img
                                src="{{ $images->whereIn('product_id', $book->id)->whereIn('type', 'main')->first()->path  ?? '/images/book_covers/error.png'  }}"
                                class="img-fluid book-cover pt-2"
                                alt="Book cover">
                            <div class="w-100 pt-2 ps-3">
                                <input class="form-check-input" type="checkbox" value="1" id="img1_del_checkbox"
                                       name="img1_del_checkbox">
                                <label class="form-check-label" for="img1_del_checkbox">
                                    Vymazať hlavný obrázok
                                </label>
                            </div>
                            <label class="ps-3 pt-4" for="image2">Nahradiť hlavný obrázok</label>
                            <input type="file" class="form-control mt-2" id="image1" name="image1"/>
                            <span class="text-danger"> @error('image1') {{$message}} @enderror</span>
                        </div>
                        <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                            <span class="ps-3">Vedľajší obrázok</span>
                            <img
                                src="{{ $images->whereIn('product_id', $book->id)->whereIn('type', 'secondary')->first()->path  ?? '/images/book_covers/error.png'  }}"
                                class="img-fluid book-cover pt-2" alt="Book cover">
                            <div class="w-100 pt-2 ps-3">
                                <input class="form-check-input" type="checkbox" value="1" id="img2_del_checkbox"
                                       name="img2_del_checkbox">
                                <label class="form-check-label" for="img2_del_checkbox">
                                    Vymazať vedľajší obrázok
                                </label>
                            </div>
                            <label class="ps-3 pt-4" for="image2">Nahradiť vedľajší obrázok</label>
                            <input type="file" class="form-control mt-2" id="image2" name="image2"/>
                            <span class="text-danger"> @error('image2') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pt-4 ps-4 pe-4 pb-4">
                            <label class="ps-3" for="description">Popis knihy</label>
                            <textarea id="description" class="form-control" rows="5" name="description"
                                      required>{{ $book->description }}</textarea>
                            <span class="text-danger"> @error('description') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-xl mt-4 mb-5 rounded-extra float-end me-5" id="edit">
                    Upraviť knihu
                </button>
            </form>
        </section>
    </div>
@stop
