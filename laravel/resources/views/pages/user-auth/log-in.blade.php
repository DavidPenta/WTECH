@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/log-in-style.css">
@stop
@php
    $user_email = Session::get('user_email');
    if (empty($user_email)) {
        $user_email = old('user_email');
    }
@endphp
@section('content')
    <section id="container-expanding" class="container align-middle align-middle">
        @if (!empty($success))
            <div class="alert alert-success text-center w-100 mt-5 mx-auto">
                <strong>{{$success}}</strong>
            </div>
        @endif
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
        <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-5 pb-3">
            <h1 class="text-center pb-4">Prihlásenie</h1>
            <form id="log-in" class="container" action="{{route('login-user')}}" method="post">
                @csrf
                <fieldset class="form-group">
                    <label class="text-center pb-2 ps-3" for="user_email">Email</label>
                    <input name="user_email" type="text" class="form-control" id="user_email" value="{{$user_email}}" maxlength="255">
                    <span class="text-danger"> @error('email') {{$message}} @enderror</span>
                </fieldset>
                <fieldset class="pt-4 form-group">
                    <label class="text-center pb-2 ps-3" for="user_password">Heslo</label>
                    <input name="user_password" type="password" class="form-control" id="user_password" value="{{old('user_password')}}">
                    <span class="text-danger"> @error('password') {{$message}} @enderror</span>
                </fieldset>
            </form>
            <a class="text-decoration-none" href="forgot-password">
                <p class="text-center pt-4 text-muted">Zabudnuté heslo</p>
            </a>
        </div>
        <button form="log-in" class="btn btn-success w-100 mt-4 mb-5 rounded-extra pt-2 pb-2 fs-5" type="submit">
            Prihlásiť sa
        </button>
    </section>
@stop
