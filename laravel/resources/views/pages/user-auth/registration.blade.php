@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/style.css">
@stop
@section('content')
    <div class="container align-middle align-middle">
        <div class="container align-middle pt-4 bg-white shadow-sm rounded-extra mt-5 pb-3">
            <h1 class="text-center pt-3 pb-3">Registrácia</h1>
            @if (Session::has('success'))
                <div class="alert alert-success text-center w-50 pt-3 mx-auto">
                    <strong>{{Session::get('success')}}</strong>
                </div>
            @endif
            @if (Session::has('fail'))
                <div class="alert alert-danger text-center w-50 pt-3 mx-auto">
                    <strong>{{Session::get('fail')}}</strong>
                </div>
            @endif
            <form class="row g-3" action="{{route('register-user')}}" id="registration" method="post">
                @csrf
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="name">Meno*</label>
                    <input required id=name name="name" type="text" class="form-control" maxlength="64" value="{{old('name')}}">
                    <span class="text-danger"> @error('name') {{$message}} @enderror</span>
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="surname">Priezvisko*</label>
                    <input required id="surname" name="surname" type="text" class="form-control" maxlength="64" value="{{old('surname')}}">
                    <span class="text-danger"> @error('surname') {{$message}} @enderror</span>
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="email">Email*</label>
                    <input required id=email name="email" type="text" class="form-control" maxlength="254" value="{{old('email')}}">
                    <span class="text-danger"> @error('email') {{$message}} @enderror</span>
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="phone">Telefónne číslo</label>
                    <input id="phone" name="phone" type="text" class="form-control" maxlength="15" minlength="10" value="{{old('phone')}}">
                    <span class="text-danger"> @error('phone') {{$message}} @enderror</span>
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="city">Mesto</label>
                    <input id="city" name="city" type="text" class="form-control" maxlength="128" value="{{old('city')}}">
                    <span class="text-danger"> @error('city') {{$message}} @enderror</span>
                </div>
                <div class="col-12 col-md-6 pt-4 ps-4 pe-4">
                    <label class="ps-2" for="postcode">PSČ</label>
                    <input id=postcode name="postcode" type="text" class="form-control" maxlength="10" value="{{old('postcode')}}">
                    <span class="text-danger"> @error('postcode') {{$message}} @enderror</span>
                </div>
                <div class="col-12 pt-4 ps-4 ps-4 pe-4 pb-5">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <label class="ps-2" for="street">Ulica</label>
                            <input id="street" name="street" type="text" class="form-control" maxlength="128" value="{{old('street')}}">
                            <span class="text-danger"> @error('street') {{$message}} @enderror</span>
                        </div>
                        <div class="col-3">
                            <label class="ps-3" for="street_number">Číslo</label>
                            <input id="street_number" name="street_number" type="text" class="form-control" maxlength="16" value="{{old('street_number')}}">
                            <span class="text-danger"> @error('street-number') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pt-5 ps-4 pe-4 ">
                    <label class="ps-2" for="password_1">Heslo*</label>
                    <input required id="password_1" name="password_1" type="password" class="form-control" minlength="5" value="{{old('password_1')}}">
                    <span class="text-danger"> @error('password') {{$message}} @enderror</span>
                </div>
                <div class="col-12 col-md-6 pt-5 ps-4 pe-4 pb-5">
                    <label class="ps-2" for="password_2">Heslo znovu*</label>
                    <input required id="password_2" name="password_2" type="password" minlength="5" class="form-control" value="{{old('password_2')}}">
                    <span class="text-danger"> @error('password_2') {{$message}} @enderror</span>
                </div>
            </form>
        </div>
        <div class="text-center">
            <button class="btn btn-success mt-4 mb-5 btn-xxl float-sm-end me-sm-5" form="registration" type="submit">
                Registrovať sa
            </button>
        </div>
    </div>
@stop
