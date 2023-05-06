<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Favorites;

class BookMock
{
    public int $id;
    public string $name;
    public string $authorName;
    public string $publisherName;
    public int $pageCount;
    public string $description;
    public float $price;

    public function __construct(int    $id,
                                string $name,
                                string $authorName,
                                string $publisherName,
                                int    $pageCount,
                                string $description,
                                float  $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->authorName = $authorName;
        $this->publisherName = $publisherName;
        $this->pageCount = $pageCount;
        $this->description = $description;
        $this->price = $price;
    }
}

class ProductsController extends Controller
{
    private static array $defaultValues = [
        'minPrice' => 0,
        'maxPrice' => 10000,
        'minPages' => 1,
        'maxPages' => 10000,
        'pageSize' => 10
    ];

    private static array $categoryTitleMapping = [
        'bestseller' => 'Bestsellery',
        'news' => 'Novinky',
        'youngadult' => 'Young Adult',
        'romance' => 'Romantika',
        'crime' => 'Krimi a detektívky',
        'thriller' => 'Trilery',
        'adventure' => 'Dobrodružné',
        'family' => 'Rodina',
        'fantasy' => 'Fantasy',
        'scifi' => 'Sci-fi',
        'novels' => 'Romány a novely',
        'biography' => 'Biografie',
        'poetry' => 'Poézia',
        'lifestyle' => 'Životný štýl',
        'children' => 'Deti a mládež',
        'education' => 'Náučná a odborná literatúra',
        'all' => 'Všetky vyhľadávania'
    ];

    private static array $categoryOrderOptions = [
        'new',
        'old',
        'cheap',
        'expensive',
        'short',
        'long'
    ];

    private static array $bookLanguageOptions = [
        'all',
        'sk',
        'en',
        'cz',
        'de'
    ];

    public function ParseShoppingCartCookie(string $value)
    {
        // TODO
    }

    public function CategoryRoute(Request $req)
    {
        $searchQuery = $req->search;
        $pageNumber = $req->page;
        $categoryNameFromRequest = $req->categoryName;
        $categoryName = array_key_exists($categoryNameFromRequest, self::$categoryTitleMapping)
            ? self::$categoryTitleMapping[$req->categoryName]
            : 'Neznáma kategória';
        $categoryOrderFromRequest = $req->order;
        $categoryOrder = in_array($categoryOrderFromRequest, self::$categoryOrderOptions)
            ? $categoryOrderFromRequest
            : 'new';
        $minPrice = $req->{'min-price'} ?? self::$defaultValues['minPrice'];
        $maxPrice = $req->{'max-price'} ?? self::$defaultValues['maxPrice'];
        $minPages = $req->{'min-pages'} ?? self::$defaultValues['minPages'];
        $maxPages = $req->{'max-pages'} ?? self::$defaultValues['maxPages'];
        $languageFromRequest = $req->language;
        $language = in_array($languageFromRequest, self::$bookLanguageOptions)
            ? $languageFromRequest
            : 'all';

        $bookOrderingProperty = $categoryOrder == 'new' || $categoryOrder == 'old' ? 'date' : ($categoryOrder == 'cheap' || $categoryOrder == 'expensive' ? 'price' : ($categoryOrder == 'short' || $categoryOrder == 'long' ? 'num_of_pages' : 'id'));
        $bookOrderingDirection = $categoryOrder == 'old' || $categoryOrder == 'cheap' || $categoryOrder == 'short' ? 'asc' : 'desc';
        if (request('search')) {
            $books = Product::with('mainImage')
                ->where('name','LIKE','%'.$searchQuery.'%')
                ->orWhere('author','LIKE','%'.$searchQuery.'%')
                ->orWhere('description','LIKE','%'.$searchQuery.'%')
                ->where('price', '>',$minPrice)
                ->where('price', '<', $maxPrice)
                ->where('num_of_pages', '>', $minPages)
                ->where('num_of_pages', '<', $maxPages)
                ->orderBy($bookOrderingProperty, $bookOrderingDirection)
                ->skip(self::$defaultValues['pageSize'] * ($pageNumber - 1))
                ->take(self::$defaultValues['pageSize'])
                ->get();
            \Log::debug($books);
            $maxPageNumber = ceil(count($books) / self::$defaultValues['pageSize']);
            $categoryName = "Vyhľadávanie: " . $searchQuery;
        } else {
            $books = Product::with('mainImage')
                ->where('price', '>',$minPrice)
                ->where('price', '<', $maxPrice)
                ->where('num_of_pages', '>', $minPages)
                ->where('num_of_pages', '<', $maxPages)
                ->orderBy($bookOrderingProperty, $bookOrderingDirection)
                ->skip(self::$defaultValues['pageSize'] * ($pageNumber - 1))
                ->take(self::$defaultValues['pageSize'])
                ->get();
            \Log::debug($books);
            $maxPageNumber = ceil(count($books) / self::$defaultValues['pageSize']);
        }

        return view('pages/products/category', [
            'category' => $categoryNameFromRequest,
            'categoryName' => $categoryName,
            'categoryOrder' => $categoryOrder,
            'pageNumber' => $pageNumber,
            'maxPageNumber' => $maxPageNumber,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'minPages' => $minPages,
            'maxPages' => $maxPages,
            'language' => $language,
            'bookList' => $books
        ]);
    }

    public function ProductDetailRoute(Request $req)
    {
        $productId = $req->{'product-id'};
        $bookData = Product::with('images')->find($productId);
        if (!$req->session()->has('UserId'))
        {
            return view('pages/products/product-detail', [
                'bookData' => $bookData,
                'isFavorite' => false
            ]);
        }

        $userId = $req->session()->has('UserId') ?  $req->session()->get('UserId') : '';
        $isFavorite = Favorites::where('product_id', '=', $productId)
            ->where('user_id', '=', $userId)
            ->get()
            ->count() > 0;
        \Log::debug($bookData);
        \Log::debug($isFavorite);
        return view('pages/products/product-detail', [
            'bookData' => $bookData,
            'isFavorite' => $isFavorite
        ]);
    }

    public function ProductDetailPostRoute(Request $req)
    {
        $postAction = $req->{'post-action'};
        if ($postAction == 'favorite')
        {
            return self::ProductDetailFavoriteRoute($req);
        }
        else if ($postAction == 'addToCart')
        {
            return self::ProductDetailAddToCartRoute($req);
        }
        else
        {
            $bookData = Product::with('images')->find($productId);
            return view('pages/products/product-detail', [
                'bookData' => $bookData,
                'isFavorite' => false
            ]);
        }
    }

    public function ProductDetailFavoriteRoute(Request $req)
    {
        $productId = $req->{'product-id'};
        $bookData = Product::with('images')->find($productId);
        \Log::debug($productId);
        if (!$req->session()->has('UserId'))
        {
            return view('pages/products/product-detail', [
                'bookData' => $bookData,
                'isFavorite' => false
            ]);
        }

        $userId = $req->session()->has('UserId') ?  $req->session()->get('UserId') : '';
        $favorite = Favorites::where('product_id', '=', $productId)->where('user_id', '=', $userId);

        if (count($favorite->get()) > 0)
        {
            $favorite->delete();
            $isFavorite = false;
        }
        else
        {
            $favorite = new Favorites;
            $favorite->user_id = $userId;
            $favorite->product_id = $productId;
            $favorite->save();
            $isFavorite = true;
        }
        \Log::debug($bookData);
        \Log::debug($isFavorite);
        return view('pages/products/product-detail', [
            'bookData' => $bookData,
            'isFavorite' => $isFavorite
        ]);
    }

    public function ProductDetailAddToCartRoute(Request $req)
    {
        $productId = $req->{'product-id'};
        $userId = $req->session()->has('UserId') ?  $req->session()->get('UserId') : '';
        return view('pages/products/product-detail', [
            'bookData' => $bookData,
            'isFavorite' => $isFavorite
        ]);
    }
}
