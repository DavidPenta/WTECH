<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Product;
use App\models\Image;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private static array $categoryTitleMapping = [
        'Bestsellery' => 1,
        'Novinky' => 2,
        'Young Adult' => 3,
        'Romantika' => 4,
        'Krimi a detektívky' => 5,
        'Trilery' => 6,
        'Dobrodružné' => 7,
        'Rodina' => 8,
        'Fantasy' => 9,
        'Sci-fi' => 10,
        'Romány a novely' => 11,
        'Biografie' => 12,
        'Poézia' => 13,
        'Životný štýl' => 14,
        'Deti a mládež' => 15,
        'Náučná a odborná literatúra' => 16,
        'Všetky vyhľadávania' => 17
    ];
    public function saveBook(Request $request) {

        $request->validate([
            'name' => 'required|max:255',
            'author' => 'required|numeric',
            'category' => 'required',
            'price' => 'required|max:255',
            'date' => 'required',
            'language' => 'required|max:255',
            'num_of_pages' => 'required|numeric',
            'publisher' => 'required|max:255',
            'image1' => 'required|max:255',
            'image2' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->author = $request->author;
        $product->category_id = self::$categoryTitleMapping[$request->category];
        $product->price = $request->price;
        $product->date = $request->date;
        $product->language = $request->language;
        $product->num_of_pages = $request->num_of_pages;
        $product->publisher = $request->publisher;
        $product->description = $request->description;
        $product->save();


        $image1 = new Image;
        $image1->product_id = $product->id;
        $image1->type = substr(strrchr($request->image1, '.'), 1);
        $image1->path = $request->image1;
        $image1->save();

        $image2 = new Image;
        $image2->product_id = $product->id;
        $image2->type = substr(strrchr($request->image2, '.'), 1);
        $image2->path = $request->image2;
        $image2->save();

        return redirect('pages/admin/admin-book-edit-list')->with('success', 'Product added successfully!');

    }
}
