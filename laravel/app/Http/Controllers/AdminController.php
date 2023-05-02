<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Product;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function saveBook(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'author' => 'required|numeric',
            'category' => 'required',
            'price' => 'required|max:255',
            'date' => 'required',
            'language' => 'required|max:255',
            'num_of_pages' => 'required|numeric',
            'publisher' => 'required|max:255',/*
            'image1' => 'required|max:255',
            'inage2' => 'required|max:255',*/
            'description' => 'required|max:255',
        ]);

        DB::table('product')->insert([
            'name' => $validatedData['nazov'],
            'author' => $validatedData['author'],
            'category' => $validatedData['category'],
            'price' => $validatedData['price'],
            'date' => $validatedData['date'],
            'language' => $validatedData['language'],
            'num_of_pages' => $validatedData['num_of_pages'],
            'publisher' => $validatedData['publisher'],/*
            'image1' => $validatedData['image1'],
            'image2' => $validatedData['image2'],*/
            'description' => $validatedData['description'],
        ]);

        return redirect('pages/admin/admin-book-edit-list')->with('success', 'Product added successfully!');

    }
}
