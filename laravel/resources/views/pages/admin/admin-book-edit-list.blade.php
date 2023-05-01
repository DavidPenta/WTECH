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
            <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-4 pb-3">
                <article class="align-middle bg-light shadow-sm rounded-extra mb-4">
                    <div class="row p-3">
                        <div class="d-flex col-1 align-center text-center">
                            <img class="img-fluid align-center" src="../../images/book_covers/book.png" alt="Book cover"/>
                        </div>
                        <div class="container col-3 align-right">
                            <div class="row">
                                <div class="d-flex container align-left px-0">
                                    <div class="p-1">
                                        <h5 class="ms-2 mb-1"><b>Názov knihy</b></h5>
                                        <p class="ms-2">Autor knihy</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <div class="d-flex align-left pt-4">
                                <span class="fs-4 mt-3 text-black"><b>13,25€</b></span>
                            </div>
                        </div>
                        <div class="col-3 align-left text-center">
                            <a href="admin-book-edit.html">
                                <button type="button" class="btn btn-success btn-xl mt-4 rounded-extra float-end" id="upravknihu">
                                    Upraviť
                                </button>
                            </a>
                        </div>
                        <div class="col-3 align-right text-center float-end">
                            <a href="#" class="float-end align-right">
                                <button type="button" class="float-end btn btn-danger btn-xl mt-4 rounded-extra float-end"
                                        id="odstran">Odstániť
                                </button>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>
@stop
