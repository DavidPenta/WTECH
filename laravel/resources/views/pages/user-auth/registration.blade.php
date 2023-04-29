@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/style.css">
@stop
@section('content')
    <div class="container align-middle align-middle">
        <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-5 pb-3">
            <h1 class="text-center pt-3 pb-3">Registrácia</h1>
            <form class="row g-3">
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="name">Meno*</label>
                    <input id=name type="text" class="form-control" maxlength="64">
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="surname">Priezvisko*</label>
                    <input id="surname" type="text" class="form-control" maxlength="64">
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="email">Email*</label>
                    <input id=email type="text" class="form-control" maxlength="254">
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="phone">Telefónne číslo</label>
                    <input id="phone" type="text" class="form-control" maxlength="15">
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="city">Mesto</label>
                    <input id="city" type="text" class="form-control" maxlength="128">
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="postcode">PSČ</label>
                    <input id=postcode type="text" class="form-control" maxlength="10">
                </div>
                <div class="col-12 pt-4 ps-4 ps-4 pe-4 pb-5">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <label class="ps-2" for="street">Ulica</label>
                            <input id="street" type="text" class="form-control" maxlength="128">
                        </div>
                        <div class="col-3">
                            <label class="ps-3" for="street-number">Číslo</label>
                            <input id="street-number" type="text" class="form-control" maxlength="16">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pt-5 ps-4 pe-4 ">
                    <label class="ps-2" for="password">Heslo*</label><input id="password" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-6 pt-5 ps-4 pe-4 pb-5">
                    <label class="ps-2" for="password_2">Heslo znovu*</label><input id="password_2" type="text"
                                                                                    class="form-control">
                </div>
            </form>
        </div>
        <div class="text-center">
            <a href="/" class="btn btn-success mt-4 mb-5 btn-xxl float-sm-end me-sm-5" role="button">Registrovať sa</a>
        </div>
    </div>
@stop
