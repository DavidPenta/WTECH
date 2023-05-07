<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Favorites;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    private static array $defaultValues = [
        'minPrice' => 0,
        'maxPrice' => 10000,
        'minPages' => 1,
        'maxPages' => 10000,
        'pageSize' => 10
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
        $foundCategories = Category::where('short', '=', $categoryNameFromRequest)
            ->get();
        if (count($foundCategories) == 0)
        {
            $category = (object) [
                'id' => -1,
                'full' => $categoryNameFromRequest == 'search' ? 'Vyhľadávanie: "'.$searchQuery.'"' : 'Neznáma kategória'
            ];
        }
        else
        {
            $category = $foundCategories[0];
        }
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
        } else {
            $allBooks = Product::with('mainImage')
                ->where('category_id', '=', $category->id)
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
            'search' => $searchQuery,
            'category' => $categoryNameFromRequest,
            'categoryName' => $category->full,
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

    private function getBooksOrderedByFavorite()
    {
        return DB::select('SELECT a.id, a.name, a.author, a.description, a.language, a.num_of_pages, a.publisher, a.price, a.date, count(*) as c
                                   FROM "Product" as a FULL OUTER JOIN "Favorites" as b ON (b.product_id = a.id)
                                   GROUP BY a.id
                                   ORDER BY c DESC LIMIT 10;');
    }
    public function index(Request $request)
    {
        $images = Image::all();
        $favorite_bool = false;
        if ($request->session()->has('UserId')){
            $favorites = Favorites::where('user_id', '=', $request->session()->get('UserId'))->get();
            $books = Product::whereIn('id', $favorites->pluck('product_id'))->get();
            $favorite_bool = true;
        }
        else {
            $books = $this->getBooksOrderedByFavorite();
        }
        $number_of_bestsellers = round(count($books) / 2);
        if ($number_of_bestsellers == 0) {
            $favorite_bool = false;
            $books = $this->getBooksOrderedByFavorite();
            $number_of_bestsellers = 5;
        }
        $bestsellers = Product::inRandomOrder()->where('category_id','=', 1)->take($number_of_bestsellers)->get();
        return view('pages/index', ['bookList' => $books, 'bestsellers' => $bestsellers, 'images' => $images, 'favorites' => $favorite_bool]);
    }
}
