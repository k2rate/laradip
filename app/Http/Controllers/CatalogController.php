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

        $sort_type = $req['sort_type'];
        if($sort_type == null)
            $sort_type = 'default';

        $products = null;

        if ($category_id != 0)
        {
            if($sort_type == 'default')
            {
                $products = Product::where('category_id', $category_id)->get();
            }
            else if ($sort_type == 'cost')
            {
                $products = Product::where('category_id', $category_id)->orderBy('cost')->get();
            }
            else if ($sort_type == 'name')
            {
                $products = Product::where('category_id', $category_id)->orderBy('name')->get();
            }
            else if ($sort_type == 'year')
            {
                $products = Product::where('category_id', $category_id)->orderBy('year')->get();
            }
        }
        else
        {
            if($sort_type == 'default')
            {
                $products = Product::all();
            }
            else if ($sort_type == 'cost')
            {
                $products = Product::orderBy('cost')->get();
            }
            else if ($sort_type == 'name')
            {
                $products = Product::orderBy('name')->get();
            }
            else if ($sort_type == 'year')
            {
                $products = Product::orderBy('year')->get();
            }
        }


        $categories = Category::all();

        return view('catalog', compact('products', 'categories', 'category_id', 'sort_type'));
    }
}
