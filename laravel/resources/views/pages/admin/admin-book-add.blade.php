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
            {{ csrf_field() }}
            <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-4 pb-3">
                <h3 class="text-center pb-5">Pridanie knihy</h3>
                    <div class="row">
                        <div class="col ps-5"><label class="ps-3" for="nazov">Názov knihy</label><input id="nazov"
                                                                                                        type="text"
                                                                                                        class="form-control"/>
                        </div>
                        <div class="col"><label class="ps-3" for="autor">Autor</label><input id="autor" type="text"
                                                                                             class="form-control"/></div>
                    </div>
                    <div class="row pt-4">
                        <div class="col ps-5">
                            <label class="ps-3" for="kategoria">Kategória</label>
                            <select class="form-control" id="kategoria">
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
                        <div class="col"><label class="ps-3" for="cena">Cena</label><input id="cena" type="text"
                                                                                           class="form-control"/></div>
                    </div>
                    <div class=""></div>
                    <div class="row pt-4">
                        <div class="col ps-5"><label class="ps-3" for="datum">Dátum vydania</label><input id="datum"
                                                                                                          type="text"
                                                                                                          class="form-control"/>
                        </div>
                        <div class="col"><label for="obrazok1">Obrázok č. 1</label><input type="file" class="form-control"
                                                                                          id="obrazok1"/></div>
                    </div>
                    <div class="row pt-4 pb-5">
                        <div class="col ps-5"><label class="ps-3" for="popis">popis knihy</label><textarea id="popis"
                                                                                                           class="form-control"
                                                                                                           rows="5"></textarea>
                        </div>
                        <div class="col"><label for="obrazok1">Obrázok č. 2</label><input type="file" class="form-control"
                                                                                          id="obrazok2"/></div>
                    </div>
            </div>
            <button type="submit" class="btn btn-success btn-xl mt-4 mb-5 rounded-extra float-end me-5" id="pridat">Pridať knihu
            </button>
        </form>
    </section>
</div>
@stop
