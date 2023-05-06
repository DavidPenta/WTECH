<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Favorites;
use App\Models\Order;
use App\Models\OrderProduct;

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

    public function SerializeShoppingCartCookie(array $value)
    {
        $results = [];
        \Log::debug($value);
        foreach ($value as $bookId => $bookCount)
        {
            array_push($results, $bookId.'='.$bookCount);
        }
        $result = implode(';', $results);
        return $result;
    }

    public function DeserializeShoppingCartCookie(string $value)
    {
        $result = [];
        if ($value == '')
        {
            return $result;
        }
        $books = explode(';', $value);
        \Log::debug($value);
        \Log::debug($books);
        foreach ($books as $bookData)
        {
            $idAndCount = explode('=', $bookData);
            $bookId = $idAndCount[0];
            $bookCount = $idAndCount[1];
            $result[$bookId] = $bookCount;
        }
        return $result;
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
            $allBooks = Product::with('mainImage')
                ->where('name','LIKE','%'.$searchQuery.'%')
                ->orWhere('author','LIKE','%'.$searchQuery.'%')
                ->orWhere('description','LIKE','%'.$searchQuery.'%')
                ->where('price', '>',$minPrice)
                ->where('price', '<', $maxPrice)
                ->where('num_of_pages', '>', $minPages)
                ->where('num_of_pages', '<', $maxPages);
            $bookCount = $allBooks->count();
            $books = $allBooks->orderBy($bookOrderingProperty, $bookOrderingDirection)
                ->skip(self::$defaultValues['pageSize'] * ($pageNumber - 1))
                ->take(self::$defaultValues['pageSize'])
                ->get();
            \Log::debug($books);
            $maxPageNumber = ceil($bookCount / self::$defaultValues['pageSize']);
            $categoryName = "Vyhľadávanie: " . $searchQuery;
        } else {
            $allBooks = Product::with('mainImage')
                ->where('price', '>',$minPrice)
                ->where('price', '<', $maxPrice)
                ->where('num_of_pages', '>', $minPages)
                ->where('num_of_pages', '<', $maxPages);
            $bookCount = $allBooks->count();
            $books = $allBooks->orderBy($bookOrderingProperty, $bookOrderingDirection)
                ->skip(self::$defaultValues['pageSize'] * ($pageNumber - 1))
                ->take(self::$defaultValues['pageSize'])
                ->get();
            \Log::debug($books);
            $maxPageNumber = ceil($bookCount / self::$defaultValues['pageSize']);
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
        $images = Image::where('product_id', $productId)->get();
        $bookData = Product::with('images')->find($productId);

        if (!$req->session()->has('UserId'))
        {
            return view('pages/products/product-detail', [
                'bookData' => $bookData,
                'isFavorite' => false,
                'images' => $images
            ]);
        }

        $userId = $req->session()->get('UserId');
        $isFavorite = Favorites::where('product_id', '=', $productId)
            ->where('user_id', '=', $userId)
            ->get()
            ->count() > 0;

        return view('pages/products/product-detail', [
            'bookData' => $bookData,
            'isFavorite' => $isFavorite,
            'images' => $images
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
            $productId = $req->{'product-id'};
            $images = Image::where('product_id', $productId)->get();
            $bookData = Product::with('images')->find($productId);
            return view('pages/products/product-detail', [
                'bookData' => $bookData,
                'isFavorite' => false,
                'images' => $images
            ]);
        }
    }

    public function ProductDetailFavoriteRoute(Request $req)
    {
        $productId = $req->{'product-id'};
        $images = Image::where('product_id', $productId)->get();
        $bookData = Product::with('images')->find($productId);
        \Log::debug($productId);
        if (!$req->session()->has('UserId'))
        {
            return view('pages/products/product-detail', [
                'bookData' => $bookData,
                'isFavorite' => false,
                'images' => $images
            ]);
        }

        $userId = $req->session()->get('UserId');
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
            'isFavorite' => $isFavorite,
            'images' => $images
        ]);
    }

    public function ProductDetailAddToCartRoute(Request $req)
    {
        $productId = $req->{'product-id'};
        $images = Image::where('product_id', $productId)->get();
        $bookData = Product::with('images')->find($productId);

        if (!$req->session()->has('UserId'))
        {
            $shoppingCartFromCookies = $req->session()->has('ShoppingCart') ? $req->session()->get('ShoppingCart') : '';
            $shoppingCart = self::DeserializeShoppingCartCookie($shoppingCartFromCookies);
            if (array_key_exists($productId, $shoppingCart))
            {
                $shoppingCart[$productId]++;
            }
            else
            {
                $shoppingCart[$productId] = 1;
            }
            $shoppingCartSerialized = self::SerializeShoppingCartCookie($shoppingCart);
            $req->session()->put('ShoppingCart', $shoppingCartSerialized);
            return view('pages/products/product-detail', [
                'bookData' => $bookData,
                'isFavorite' => false,
                'images' => $images
            ]);
        }

        $userId = $req->session()->get('UserId');
        $draftOrders = Order::where('user_id', '=', $userId)
            ->where('state', '=', 'draft')
            ->get();
        
        \Log::debug($draftOrders);
        if (count($draftOrders) > 0)
        {
            $draftOrder = $draftOrders[0];
        }
        else
        {
            $draftOrder = new Order;
            $draftOrder->state = 'draft';
            $draftOrder->user_id = $userId;
            $draftOrder->save();
        }

        $orderProducts = OrderProduct::where('order_id', '=', $draftOrder->id)
            ->where('product_id', '=', $productId);

        \Log::debug($orderProducts->get());
        if ($orderProducts->count() > 0)
        {
            $orderProduct = $orderProducts->first();
        }
        else
        {
            $orderProduct = new OrderProduct;
            $orderProduct->order_id = $draftOrder->id;
            $orderProduct->product_id = $productId;
            $orderProduct->quantity = 0;
        }
        $orderProduct->quantity++;
        $orderProduct->save();

        $isFavorite = Favorites::where('product_id', '=', $productId)
            ->where('user_id', '=', $userId)
            ->get()
            ->count() > 0;

        return view('pages/products/product-detail', [
            'bookData' => $bookData,
            'isFavorite' => $isFavorite,
            'images' => $images
        ]);
    }
}
