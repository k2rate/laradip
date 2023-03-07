<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Request $req)
    {
        $category_id = $req['category_id'];
        if($category_id == null)
            $category_id = 0;
            
        $products = null;

        if ($category_id != 0)
            $products = Product::where('category_id', $category_id)->get();
        else
            $products = Product::all();

        $categories = Category::all();

        return view('catalog', compact('products', 'categories', 'category_id'));
    }
}