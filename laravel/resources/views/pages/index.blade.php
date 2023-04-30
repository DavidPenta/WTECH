@extends('layouts.default')
@section('head')
    <link rel="stylesheet" href="/styles/category-style.css">
@stop
@section('content')
<section class="container align-middle pt-3 pb-3 bg-white shadow-sm rounded-extra mt-5">
    <img class="img-fluid rounded-extra" alt="Background image of books"
            srcset="images/banner/banner-420w.jpg 420w,
                    images/banner/banner-800w.jpg 800w,
                    images/banner/banner-1920w.jpg 1920w"
            src="images/banner/banner-1920w.jpg"
    />
</section>
<div class="row">
    <aside class="col-md-3">
        <div class="align-middle pt-3 bg-white shadow-sm rounded-extra mt-4 d-none d-lg-block">
            <h3 class="mb-3 ms-4">Bestsellery</h3>
            <div class="align-middle bg-light shadow-sm rounded-extra mb-4 ms-3 me-3">
                <div class="row p-3">
                    <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                        <h5 class="ms-2 mb-1"><b>Názov knihy</b></h5>
                        <p class="ms-2">Autor knihy</p>
                        <div class="d-flex col-6 align-left text-center container">
                            <img class="img-fluid" src="images/book_covers/book.png" alt="Book cover">
                        </div>
                        <div class="d-flex justify-content-between bg-light">
                            <span class="fs-4 ms-2 mt-3 text-black"><b>13,25€</b></span>
                            <button class="mt-2 btn btn-success rounded-extra float-end">
                                <img class="img-fluid d-block mx-auto" src="images/basket/basket-light.svg" width="30"
                                        alt="Add to cart">
                            </button>
                        </div>
                    </a>
                </div>
            </div>
            <div class="align-middle bg-light shadow-sm rounded-extra mb-4 ms-3 me-3">
                <div class="row p-3">
                    <a class="text-decoration-none text-black" href="product-detail?product-id=100">
{{--                        $val -> id--}}
                        <h5 class="ms-2 mb-1"><b>Názov knihy</b></h5>
                        <p class="ms-2">Autor knihy</p>
                        <div class="d-flex col-6 align-left text-center container">
                            <img class="img-fluid" src="images/book_covers/book.png" alt="Book cover">
                        </div>
                        <div class="d-flex justify-content-between bg-light">
                            <span class="fs-4 ms-2 mt-3 text-black"><b>13,25€</b></span>
                            <button class="mt-2 btn btn-success rounded-extra float-end">
                                <img class="img-fluid d-block mx-auto" src="images/basket/basket-light.svg" width="30"
                                        alt="Add to cart">
                            </button>
                        </div>
                    </a>
                </div>
            </div>
            <div class="align-middle bg-light shadow-sm rounded-extra mb-4 ms-3 me-3">
                <div class="row p-3">
                    <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                        <h5 class="ms-2 mb-1"><b>Názov knihy</b></h5>
                        <p class="ms-2">Autor knihy</p>
                        <div class="d-flex col-6 align-left text-center container">
                            <img class="img-fluid" src="images/book_covers/book.png" alt="Book cover">
                        </div>
                        <div class="d-flex justify-content-between bg-light">
                            <span class="fs-4 ms-2 mt-3 text-black"><b>13,25€</b></span>
                            <button class="mt-2 btn btn-success rounded-extra float-end">
                                <img class="img-fluid d-block mx-auto" src="images/basket/basket-light.svg" width="30"
                                        alt="Add to cart">
                            </button>
                        </div>
                    </a>
                </div>
            </div>
            <a class="text-decoration-none text-black pb-3 d-flex align-items-center justify-content-center" href="html/products/category.html?category=bestseller&page=1"><strong>Ďalšie</strong></a>
        </div>
    </aside>
    <main class="col-12 col-lg-9 mb-5">
        <article>
            <div class="row align-middle pt-3 bg-white shadow-sm rounded-extra mt-4">
                <h1 class="col-12 pb-3 ps-5 pt-3">Odporúčené</h1>
                <div class="col-12 col-md-6 p-2">
                    <article class="bg-light shadow-sm rounded-extra p-2 ms-2 me-2">
                        <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                            <section class="p-1">
                                <h3 data-bs-toggle="tooltip" title="Názov knihy" class="offset-left text-wrap text-break">
                                    Názov knihy
                                </h3>
                                <h4 data-bs-toggle="tooltip" title="Meno autora" class="offset-left text-wrap text-break">
                                    Meno autora
                                </h4>
                            </section>
                            <section class="row p-3">
                                <section class="d-flex container col-4 align-left text-center">
                                    <img class="img-fluid mb-auto" src="images/book_covers/book.png"
                                            alt="Book cover">
                                </section>
                                <section class="d-flex container col-8 align-right">
                                    <div class="row">
                                        <section class="d-flex container align-left book-description">
                                            <p class="text-wrap text-break line-clamp">
                                                Veľmi krátky popis knihy.
                                            </p>
                                        </section>
                                        <div class="d-flex container align-left align-items-end">
                                            <div class="d-flex container col-6">
                                                <span class="fs-4 mt-3 text-black"><b>13,25€</b></span>
                                            </div>
                                            <div class="d-flex container col-6 d-flex flex-row-reverse">
                                                <button class="btn btn-success rounded-extra">
                                                    <img class="img-fluid d-block mx-auto"
                                                            src="images/basket/basket-light.svg" width="30"
                                                            alt="Add to cart">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </a>
                    </article>
                </div>
                <div class="col-12 col-md-6 p-2">
                    <article class="bg-light shadow-sm rounded-extra p-2 ms-2 me-2">
                        <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                            <section class="p-1">
                                <h3 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h3>
                                <h4 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h4>
                            </section>
                            <section class="row p-3">
                                <section class="d-flex container col-4 align-left text-center">
                                    <img class="img-fluid mb-auto" src="images/book_covers/book.png"
                                            alt="Book cover">
                                </section>
                                <section class="d-flex container col-8 align-right">
                                    <div class="row">
                                        <section class="d-flex container align-left book-description">
                                            <p class="text-wrap text-break line-clamp">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Curabitur ac neque sit amet enim porttitor pulvinar nec eu metus.
                                                Quisque purus velit, faucibus eu luctus vel, commodo ut justo. Integer eget volutpat dui.
                                                Sed sit amet orci tincidunt, ultrices ipsum a, lobortis massa.
                                                Duis consequat sapien a dolor dapibus, sit amet scelerisque neque tincidunt.
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Fusce consequat fermentum nisi, quis molestie lorem facilisis eget. Maecenas interdum sit.
                                            </p>
                                        </section>
                                        <div class="d-flex container align-left align-items-end">
                                            <div class="d-flex container col-6">
                                                <span class="fs-4 mt-3 text-black"><b>13,25€</b></span>
                                            </div>
                                            <div class="d-flex container col-6 d-flex flex-row-reverse">
                                                <button class="btn btn-success rounded-extra">
                                                    <img class="img-fluid d-block mx-auto"
                                                            src="images/basket/basket-light.svg" width="30"
                                                            alt="Add to cart">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </a>
                    </article>
                </div>
                <div class="col-12 col-md-6 p-2">
                    <article class="bg-light shadow-sm rounded-extra p-2 ms-2 me-2">
                        <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                            <section class="p-1">
                                <h3 data-bs-toggle="tooltip" title="Názov knihy" class="offset-left text-wrap text-break">
                                    Názov knihy
                                </h3>
                                <h4 data-bs-toggle="tooltip" title="Meno autora" class="offset-left text-wrap text-break">
                                    Meno autora
                                </h4>
                            </section>
                            <section class="row p-3">
                                <section class="d-flex container col-4 align-left text-center">
                                    <img class="img-fluid mb-auto" src="images/book_covers/book.png"
                                            alt="Book cover">
                                </section>
                                <section class="d-flex container col-8 align-right">
                                    <div class="row">
                                        <section class="d-flex container align-left book-description">
                                            <p class="text-wrap text-break line-clamp">
                                                Veľmi krátky popis knihy.
                                            </p>
                                        </section>
                                        <div class="d-flex container align-left align-items-end">
                                            <div class="d-flex container col-6">
                                                <span class="fs-4 mt-3 text-black"><b>13,25€</b></span>
                                            </div>
                                            <div class="d-flex container col-6 d-flex flex-row-reverse">
                                                <button class="btn btn-success rounded-extra">
                                                    <img class="img-fluid d-block mx-auto"
                                                            src="images/basket/basket-light.svg" width="30"
                                                            alt="Add to cart">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </a>
                    </article>
                </div>
                <div class="col-12 col-md-6 p-2">
                    <article class="bg-light shadow-sm rounded-extra p-2 ms-2 me-2">
                        <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                            <section class="p-1">
                                <h3 data-bs-toggle="tooltip" title="Názov knihy" class="offset-left text-wrap text-break">
                                    Názov knihy
                                </h3>
                                <h4 data-bs-toggle="tooltip" title="Meno autora" class="offset-left text-wrap text-break">
                                    Meno autora
                                </h4>
                            </section>
                            <section class="row p-3">
                                <section class="d-flex container col-4 align-left text-center">
                                    <img class="img-fluid mb-auto" src="images/book_covers/book.png"
                                            alt="Book cover">
                                </section>
                                <section class="d-flex container col-8 align-right">
                                    <div class="row">
                                        <section class="d-flex container align-left book-description">
                                            <p class="text-wrap text-break line-clamp">
                                                Veľmi krátky popis knihy.
                                            </p>
                                        </section>
                                        <div class="d-flex container align-left align-items-end">
                                            <div class="d-flex container col-6">
                                                <span class="fs-4 mt-3 text-black"><b>13,25€</b></span>
                                            </div>
                                            <div class="d-flex container col-6 d-flex flex-row-reverse">
                                                <button class="btn btn-success rounded-extra">
                                                    <img class="img-fluid d-block mx-auto"
                                                            src="images/basket/basket-light.svg" width="30"
                                                            alt="Add to cart">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </a>
                    </article>
                </div>
                <div class="col-12 col-md-6 p-2">
                    <article class="bg-light shadow-sm rounded-extra p-2 ms-2 me-2">
                        <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                            <section class="p-1">
                                <h3 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h3>
                                <h4 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h4>
                            </section>
                            <section class="row p-3">
                                <section class="d-flex container col-4 align-left text-center">
                                    <img class="img-fluid mb-auto" src="images/book_covers/book.png"
                                            alt="Book cover">
                                </section>
                                <section class="d-flex container col-8 align-right">
                                    <div class="row">
                                        <section class="d-flex container align-left book-description">
                                            <p class="text-wrap text-break line-clamp">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Curabitur ac neque sit amet enim porttitor pulvinar nec eu metus.
                                                Quisque purus velit, faucibus eu luctus vel, commodo ut justo. Integer eget volutpat dui.
                                                Sed sit amet orci tincidunt, ultrices ipsum a, lobortis massa.
                                                Duis consequat sapien a dolor dapibus, sit amet scelerisque neque tincidunt.
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Fusce consequat fermentum nisi, quis molestie lorem facilisis eget. Maecenas interdum sit.
                                            </p>
                                        </section>
                                        <div class="d-flex container align-left align-items-end">
                                            <div class="d-flex container col-6">
                                                <span class="fs-4 mt-3 text-black"><b>13,25€</b></span>
                                            </div>
                                            <div class="d-flex container col-6 d-flex flex-row-reverse">
                                                <button class="btn btn-success rounded-extra">
                                                    <img class="img-fluid d-block mx-auto"
                                                            src="images/basket/basket-light.svg" width="30"
                                                            alt="Add to cart">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </a>
                    </article>
                </div>
                <div class="col-12 col-md-6 p-2">
                    <article class="bg-light shadow-sm rounded-extra p-2 ms-2 me-2">
                        <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                            <section class="p-1">
                                <h3 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h3>
                                <h4 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h4>
                            </section>
                            <section class="row p-3">
                                <section class="d-flex container col-4 align-left text-center">
                                    <img class="img-fluid mb-auto" src="images/book_covers/book.png"
                                            alt="Book cover">
                                </section>
                                <section class="d-flex container col-8 align-right">
                                    <div class="row">
                                        <section class="d-flex container align-left book-description">
                                            <p class="text-wrap text-break line-clamp">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Curabitur ac neque sit amet enim porttitor pulvinar nec eu metus.
                                                Quisque purus velit, faucibus eu luctus vel, commodo ut justo. Integer eget volutpat dui.
                                                Sed sit amet orci tincidunt, ultrices ipsum a, lobortis massa.
                                                Duis consequat sapien a dolor dapibus, sit amet scelerisque neque tincidunt.
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Fusce consequat fermentum nisi, quis molestie lorem facilisis eget. Maecenas interdum sit.
                                            </p>
                                        </section>
                                        <div class="d-flex container align-left align-items-end">
                                            <div class="d-flex container col-6">
                                                <span class="fs-4 mt-3 text-black"><b>13,25€</b></span>
                                            </div>
                                            <div class="d-flex container col-6 d-flex flex-row-reverse">
                                                <button class="btn btn-success rounded-extra">
                                                    <img class="img-fluid d-block mx-auto"
                                                            src="images/basket/basket-light.svg" width="30"
                                                            alt="Add to cart">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </a>
                    </article>
                </div>
                <div class="col-12 col-md-6 p-2">
                    <article class="bg-light shadow-sm rounded-extra p-2 ms-2 me-2">
                        <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                            <section class="p-1">
                                <h3 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h3>
                                <h4 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h4>
                            </section>
                            <section class="row p-3">
                                <section class="d-flex container col-4 align-left text-center">
                                    <img class="img-fluid mb-auto" src="images/book_covers/book.png"
                                            alt="Book cover">
                                </section>
                                <section class="d-flex container col-8 align-right">
                                    <div class="row">
                                        <section class="d-flex container align-left book-description">
                                            <p class="text-wrap text-break line-clamp">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Curabitur ac neque sit amet enim porttitor pulvinar nec eu metus.
                                                Quisque purus velit, faucibus eu luctus vel, commodo ut justo. Integer eget volutpat dui.
                                                Sed sit amet orci tincidunt, ultrices ipsum a, lobortis massa.
                                                Duis consequat sapien a dolor dapibus, sit amet scelerisque neque tincidunt.
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Fusce consequat fermentum nisi, quis molestie lorem facilisis eget. Maecenas interdum sit.
                                            </p>
                                        </section>
                                        <div class="d-flex container align-left align-items-end">
                                            <div class="d-flex container col-6">
                                                <span class="fs-4 mt-3 text-black"><b>13,25€</b></span>
                                            </div>
                                            <div class="d-flex container col-6 d-flex flex-row-reverse">
                                                <button class="btn btn-success rounded-extra">
                                                    <img class="img-fluid d-block mx-auto"
                                                            src="images/basket/basket-light.svg" width="30"
                                                            alt="Add to cart">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </a>
                    </article>
                </div>
                <div class="col-12 col-md-6 p-2">
                    <article class="bg-light shadow-sm rounded-extra p-2 ms-2 me-2">
                        <a class="text-decoration-none text-black" href="product-detail?product-id=100">
                            <section class="p-1">
                                <h3 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h3>
                                <h4 data-bs-toggle="tooltip" title="Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger" class="offset-left text-truncate">
                                    Lorem ipsum dolor sit amet, consecteturadipiscingelitinteger.
                                </h4>
                            </section>
                            <section class="row p-3">
                                <section class="d-flex container col-4 align-left text-center">
                                    <img class="img-fluid mb-auto" src="images/book_covers/book.png"
                                            alt="Book cover">
                                </section>
                                <section class="d-flex container col-8 align-right">
                                    <div class="row">
                                        <section class="d-flex container align-left book-description">
                                            <p class="text-wrap text-break line-clamp">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Curabitur ac neque sit amet enim porttitor pulvinar nec eu metus.
                                                Quisque purus velit, faucibus eu luctus vel, commodo ut justo. Integer eget volutpat dui.
                                                Sed sit amet orci tincidunt, ultrices ipsum a, lobortis massa.
                                                Duis consequat sapien a dolor dapibus, sit amet scelerisque neque tincidunt.
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Fusce consequat fermentum nisi, quis molestie lorem facilisis eget. Maecenas interdum sit.
                                            </p>
                                        </section>
                                        <div class="d-flex container align-left align-items-end">
                                            <div class="d-flex container col-6">
                                                <span class="fs-4 mt-3 text-black"><b>13,25€</b></span>
                                            </div>
                                            <div class="d-flex container col-6 d-flex flex-row-reverse">
                                                <button class="btn btn-success rounded-extra">
                                                    <img class="img-fluid d-block mx-auto"
                                                            src="images/basket/basket-light.svg" width="30"
                                                            alt="Add to cart">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </a>
                    </article>
                </div>
            </div>
        </article>
    </main>
</div>
@stop
