<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        'education' => 'Náučná a odborná literatúra'
    ];

    public function CategoryRoute(Request $req)
    {
        $pageNumber = $req->page;
        $categoryNameFromRequest = $req->categoryName;
        $categoryName = 'Neznáma kategória';
        if (array_key_exists($categoryNameFromRequest, self::$categoryTitleMapping))
        {
            $categoryName = self::$categoryTitleMapping[$req->categoryName];
        }
        $books = [
            new BookMock(1, 'Book Name', 'Author Name', 'Publisher Name', 105, 'Description', 20.50),
            new BookMock(2, 'Book Name', 'Author Name', 'Publisher Name', 26, 'Description', 30.50),
            new BookMock(3, 'Book Name', 'Author Name', 'Publisher Name', 438, 'Description', 9.00)
        ]; // Mocked, use db later
        return view('pages/products/category', ['categoryName' => $categoryName, 'pageNubmer' => $pageNumber, 'bookList' => $books]);
    }
    public function ProductDetailRoute(Request $req)
    {
        $productId = $req->{'product-id'};
        $bookData = new BookMock(1, 'Book Name', 'Author Name', 'Publisher Name', 5, 'Description', 20.50); // Mocked, use db later
        return view('pages/products/product-detail', ['bookData' => $bookData]);
    }
}
