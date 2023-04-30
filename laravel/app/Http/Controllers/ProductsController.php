<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BookMock
{
    public int $id;
    public string $name;
    public string $authorName;
    public string $publisherName;
    public int $pageCount;
    public string $description;
    public float $price;

    public function __construct(int $id,
                                string $name,
                                string $authorName,
                                string $publisherName,
                                int $pageCount,
                                string $description,
                                float $price)
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

    public function CategoryRoute(Request $req)
    {
        $pageNumber = $req->page;
        $maxPageNumber = 20;
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
        \Log::debug($req->all());
        \Log::debug($categoryOrder);
        /*$books = [
            new BookMock(1, 'Book Name', 'Author Name', 'Publisher Name', 105, 'Description', 20.50),
            new BookMock(2, 'Book Name', 'Author Name', 'Publisher Name', 26, 'Description', 30.50),
            new BookMock(3, 'Book Name', 'Author Name', 'Publisher Name', 438, 'Description', 9.00)
        ];*/ // Mocked, use db later
        $books = Product::all(); 
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
        $bookData = Product::find($productId);
        //$bookData = new BookMock(1, 'Book Name', 'Author Name', 'Publisher Name', 5, 'Description', 20.50); // Mocked, use db later
        return view('pages/products/product-detail', ['bookData' => $bookData]);
    }
}
