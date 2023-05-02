@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/log-in-style.css">
@stop
@section('content')
    <section id="container-expanding" class="container align-middle align-middle">
        <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-5 pb-5">
            <h3 class="text-center pb-4">Zabudnuté heslo</h3>
            <p class="text-center pb-3">Ak ste zabudli heslo, odkaz na jeho obnovu vám zašleme na váš e-mail:</p>
            <form class="container">
                <fieldset class="form-group"><label class="text-center pb-2 ps-3" for="email">Email</label><input
                        type="text" class="form-control" id="email" value=""/></fieldset>
            </form>
        </div>
        <button type="submit" class="btn btn-success w-100 mt-4 mb-5 rounded-extra" id="forgot-password">Obnoviť heslo</button>
    </section>
@stop
