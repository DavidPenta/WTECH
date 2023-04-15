<!DOCTYPE html>
<html lang="sk">
<head>
    @include('includes.head')
</head>
<body class="d-flex flex-column min-vh-100">
<header class="navbar navbar-expand-md bg-light p-3 w-100">
    @include('includes.header')
</header>
<div class="container mb-5">
    @yield('content')
</div>
<footer class="footer pb-5 pt-5 bg-dark mt-auto">
    @include('includes.footer')
</footer>
</body>
</html>
