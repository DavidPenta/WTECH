<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;
use App\models\Image;
use App\models\Favorites;
use App\models\OrderProduct;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function addBook() {
        $categories = DB::table('Category')->get();
        $languages = explode(",",trim(DB::select("SELECT enum_range(NULL::language)")[0]->enum_range, "{}"));
        $publishers = explode(",",str_replace('"', "", trim(DB::select("SELECT enum_range(NULL::publisher)")[0]->enum_range, "{}\"")));

        return view('pages/admin/admin-book-add', [
            'categories' => $categories,
            'languages' => $languages,
            'publishers' => $publishers
        ]);
    }
    public function saveBook(Request $request) {

        $request->validate([
            'name' => 'required|max:255',
            'author' => 'required|max:255',
            'category' => 'required',
            'price' => 'required|numeric',
            'date' => 'required',
            'language' => 'required',
            'num_of_pages' => 'required|numeric',
            'publisher' => 'required',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:1500',
        ]);
        $product = new Product;
        $product->name = $request->name;
        $product->author = $request->author;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->date = $request->date;

        $product->language = $request->language;
        $product->num_of_pages = $request->num_of_pages;
        $product->publisher = $request->publisher;
        $product->description = $request->description;
        $product->save();

        $image1= new Image();
        $image1->product_id = $product->id;
        $image_name = $product->id .'_main_' . time() . '.' .$request->image1->extension();
        $request->image1->move(public_path('images/book_covers'), $image_name);
        $image1->type = "main";
        $image1->path = "images/book_covers/" . $image_name;
        $image1->save();

        $image2= new Image();
        $image2->product_id = $product->id;
        $image_name = $product->id .'_secondary_' . time() . '.' .$request->image2->extension();
        $request->image2->move(public_path('images/book_covers'), $image_name);
        $image2->type = "secondary";
        $image2->path = "images/book_covers/" . $image_name;
        $image2->save();

        return redirect('admin-book-add')->with('success', 'Kniha bola pridaná úspešne!');
    }

    public function listBooks() {
        $books= DB::table('Product')->orderBy('name', 'ASC')->get();
        $images = DB::table('Image')->get();
        return view('pages/admin/admin-book-edit-list', ['books' => $books, 'images' => $images]);
    }

    public function deleteBook($id){
        $product = Product::find($id);
        Image::where('product_id', $id)->delete();
        Favorites::where('product_id', $id)->delete();
        OrderProduct::where('product_id', $id)->delete();
        $product->delete();

        return redirect('admin-book-edit-list')->with('success', 'Kniha bola vymazaná úspešne!');
    }

    public function editBook($id){
        $book = Product::find($id);

        $categories = DB::table('Category')->get();
        $languages = explode(",",trim(DB::select("SELECT enum_range(NULL::language)")[0]->enum_range, "{}"));
        $publishers = explode(",",str_replace('"', "", trim(DB::select("SELECT enum_range(NULL::publisher)")[0]->enum_range, "{}\"")));

        return view('pages/admin/admin-book-edit', [
            'book' => $book,
            'categories' => $categories,
            'languages' => $languages,
            'publishers' => $publishers
        ]);
    }

    public function saveEditedBook(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'author' => 'required|max:255',
            'category' => 'required',
            'price' => 'required|numeric',
            'date' => 'required',
            'language' => 'required',
            'num_of_pages' => 'required|numeric',
            'publisher' => 'required',
            'description' => 'required|max:1500',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->author = $request->author;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->date = $request->date;
        $product->language = $request->language;
        $product->num_of_pages = $request->num_of_pages;
        $product->publisher = $request->publisher;
        $product->description = $request->description;
        $product->save();

        if ($request->image1 != null) {
            $image1 = Image::where('product_id', $id)->where('type', 'main')->first();
            if ($image1 == null) {
                $image1 = new Image();
                $image1->product_id = $product->id;
                $image1->type = "main";
            }
            $image_name = $product->id .'_main_' . time() . '.' .$request->image1->extension();
            $request->image1->move(public_path('images/book_covers'), $image_name);
            $image1->path = "images/book_covers/" . $image_name;
            $image1->save();
        }

        if ($request->image2 != null) {
            $image2 = Image::where('product_id', $id)->where('type', 'secondary')->first();
            if ($image2 == null) {
                $image2 = new Image();
                $image2->product_id = $product->id;
                $image2->type = "main";
            }
            $image_name = $product->id .'_secondary_' . time() . '.' .$request->image2->extension();
            $request->image2->move(public_path('images/book_covers'), $image_name);
            $image2->path = "images/book_covers/" . $image_name;
            $image2->save();
        }

        return redirect('admin-book-edit-list')->with('success', 'Kniha bola upravená úspešne!');
    }

}
