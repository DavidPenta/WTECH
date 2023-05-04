@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/style.css">
@stop
@section('content')
<div class="container">
    <nav class="row">
        <div class="col-6 ps-4">
            <a href="/admin-book-add">
                <button type="button" class="btn btn-light btn-xl mt-4 rounded-extra" id="pridanie">Pridanie knihy</button>
            </a>
        </div>
        <div class="col-6">
            <a href="/admin-book-edit-list">
                <button type="button" class="btn btn-light btn-xl mt-4 rounded-extra float-end me-2" id="upravenie">Upravenie
                    kníh
                </button>
            </a>
        </div>
    </nav>
    <section class="container align-middle align-middle">
        <form class="row g-3" method="post" action="{{ route('saveBook')}}" accept-charset="UtF-8">
            @csrf
            <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-4 pb-3">
                <h3 class="text-center pb-5">Pridanie knihy</h3>
                    <div class="row">
                        <div class="col ps-5"><label class="ps-3" for="name">Názov knihy</label><input id="name"
                                                                                                        type="text"
                                                                                                        class="form-control"/>
                        </div>
                        <div class="col"><label class="ps-3" for="author">Autor</label><input id="author" type="text"
                                                                                             class="form-control"/></div>
                    </div>
                    <div class="row pt-4">
                        <div class="col ps-5"><label class="ps-3" for="language">Jazyk</label><input id="language"
                                                                                                       type="text"
                                                                                                       class="form-control"/>
                        </div>
                        <div class="col"><label class="ps-3" for="publisher">Vydavateľstvo</label><input id="publisher" type="text"
                                                                                              class="form-control"/></div>
                    </div>
                    <div class="row pt-4">
                        <div class="col ps-5">
                            <label class="ps-3" for="category">Kategória</label>
                            <select class="form-control" id="category">
                                <option>Bestsellery</option>
                                <option>Novinky</option>
                                <option>Young Adult</option>
                                <option>Romantika</option>
                                <option>Krimi a detektívky</option>
                                <option>Trilery</option>
                                <option>Dobrodružne</option>
                                <option>Rodina</option>
                                <option>Fantasy</option>
                                <option>Sci-fi</option>
                                <option>Romány a novely</option>
                                <option>Biografie</option>
                                <option>Poézia</option>
                                <option>Životný štýl</option>
                                <option>Deti a mládež</option>
                                <option>Náučná a odborná literatúra</option>
                            </select>
                        </div>
                        <div class="col"><label class="ps-3" for="price">Cena</label><input id="price" type="text"
                                                                                           class="form-control"/></div>
                    </div>
                    <div class=""></div>
                    <div class="row pt-4">
                        <div class="col ps-5"><label class="ps-3" for="date">Dátum vydania</label><input id="date"
                                                                                                          type="text"
                                                                                                          class="form-control"/>
                        </div>
                        <div class="col"><label class="ps-3" for="num_of_pages">Počet strán</label><input id="num_of_pages"
                                                                                                         type="text"
                                                                                                         class="form-control"/>
                        </div>

                    </div>
                    <div class="row pt-4 pb-5">

                        <div class="col ps-5"><label for="image1">Obrázok č. 1</label><input type="text" class="form-control"
                                                                                        id="image1"/></div>
                        <div class="col"><label for="image2">Obrázok č. 2</label><input type="text" class="form-control"
                                                                                          id="image2"/></div>
                    </div>
                <div class="col px-5"><label class="ps-3" for="description">popis knihy</label><textarea id="description"
                                                                                                         class="form-control"
                                                                                                         rows="5"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-xl mt-4 mb-5 rounded-extra float-end me-5" id="pridat">Pridať knihu
            </button>
        </form>
    </section>
</div>
@stop
