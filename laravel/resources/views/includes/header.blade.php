<div class="container">
    <div class="d-flex flex-md-grow-1 nav-left">
        <nav class="d-flex dropdown">
            <button class="btn dropdown-btn me-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                <img src="/images/sidebar.svg" width="40" height="32" alt="Menu"/>
            </button>
            <ul id="dropdown-container" class="list-inline text-center dropdown-menu">
                <li><a class="dropdown-item" href="category?categoryName=bestseller&page=1">Bestsellery</a></li>
                <li><a class="dropdown-item" href="category?categoryName=news&page=1">Novinky</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="category?categoryName=youngadult&page=1">Young Adult</a></li>
                <li><a class="dropdown-item" href="category?categoryName=romance&page=1">Romantika</a></li>
                <li><a class="dropdown-item" href="category?categoryName=crime&page=1">Krimi a detektívky</a></li>
                <li><a class="dropdown-item" href="category?categoryName=thriller&page=1">Trilery</a></li>
                <li><a class="dropdown-item" href="category?categoryName=adventure&page=1">Dobrodružne</a></li>
                <li><a class="dropdown-item" href="category?categoryName=family&page=1">Rodina</a></li>
                <li><a class="dropdown-item" href="category?categoryName=fantasy&page=1">Fantasy</a></li>
                <li><a class="dropdown-item" href="category?categoryName=scifi&page=1">Sci-fi</a></li>
                <li><a class="dropdown-item" href="category?categoryName=novels&page=1">Romány a novely</a></li>
                <li><a class="dropdown-item" href="category?categoryName=biography&page=1">Biografie</a></li>
                <li><a class="dropdown-item" href="category?categoryName=poetry&page=1">Poézia</a></li>
                <li><a class="dropdown-item" href="category?categoryName=lifestyle&page=1">Životný štýl</a></li>
                <li><a class="dropdown-item" href="category?categoryName=children&page=1">Deti a mládež</a></li>
                <li><a class="dropdown-item" href="category?categoryName=education&page=1">Náučná a odborná
                        literatúra</a></li>
            </ul>
        </nav>
        <div class="text-center">
            <ul class="navbar-nav">
                <li>
                    <div class="text-lg-right text-center">
                        <a href="/" class="text-black text-decoration-none">
                            <img class="d-none d-lg-block" src="/images/logo/logo-large.svg" width="330" height="48"
                                 alt="Kníhkupectvo Knihomoľ"/>
                            <div class="text-center">
                                <img class="d-lg-none" src="/images/logo/logo-small.svg" width="165" height="48"
                                     alt="Kníhkupectvo Knihomoľ"/>
                            </div>

                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div id="nav-right" class="text-right pt-2">
        <ul class="navbar-nav">
            <li class="nav-item ms-2 me-2 pt-1">
                <form role="search" action="{{route('category')}}" method="get">
                    <input name="search" type="search" class="align-bottom form-control form-control-dark text-bg-white" size="30"
                           placeholder="Hľadať podľa názvu, autora..." aria-label="Search">
                </form>
            </li>
            @if(Session::has('AdminId'))
                <li class="nav-item ms-2 me-2 pt-1">
                    <a id="nav-btn" href="{{route('admin-book-edit-list')}}" type="button" class="btn btn-outline-dark me-2 nav-btn">Admin</a>
                </li>
            @endif
            @if(Session::has('UserId'))
                <li class="nav-item ms-2 me-2 pt-1">
                    <a id="nav-btn" href="logout-user" type="button" class="btn btn-outline-dark me-2 nav-btn">Odhlásiť sa</a>
                </li>
            @else
                <li class="nav-item ms-2 me-2 pt-1">
                    <a id="nav-btn" href="log-in" type="button" class="btn btn-outline-dark me-2 nav-btn">Prihlásenie</a>
                </li>
                <li class="nav-item ms-2 pt-1 me-2 mb-3">
                    <a id="nav-btn" href="registration" type="button" class="btn btn-warning me-2 nav-btn">Registrácia</a>
                </li>
            @endif
            <li class="nav-item ms-2 me-2 pt-2">
                <a href="shopping-cart"
                   class="d-flex text-black text-decoration-none mb-2 justify-content-center mb-md-0"><img
                        src="/images/basket/basket.svg" class="bi me-2" width="40" height="32" alt="Go to cart"/></a>
            </li>
        </ul>
    </div>
</div>
