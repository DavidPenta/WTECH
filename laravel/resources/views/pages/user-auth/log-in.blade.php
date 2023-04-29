@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/log-in-style.css">
@stop
@section('content')
    <section id="container-expanding" class="container align-middle align-middle">
        <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-5 pb-3">
            <h1 class="text-center pb-4">Prihlásenie</h1>
            <form class="container">
                <fieldset class="form-group"><label class="text-center pb-2 ps-3" for="email">Email</label><input
                        type="text" class="form-control" id="email" value="" maxlength="254"></fieldset>
                <fieldset class="pt-4 form-group"><label class="text-center pb-2 ps-3" for="password">Heslo</label><input
                        type="text" class="form-control" id="password" value="" maxlength="64"></fieldset>
            </form>
            <a class="text-decoration-none" href="forgot-password">
                <p class="text-center pt-4 text-muted">Zabudnuté heslo</p>
            </a>
        </div>
        <a href="/" class="btn btn-success w-100 mt-4 mb-5 rounded-extra pt-2 pb-2 fs-5" role="button">Prihlásiť sa</a>
    </section>
@stop
