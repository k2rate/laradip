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

        $order = $req['order'];
        if($order == null)
            $order = 'asc';

        if ($category_id != 0)
        {
            if($sort_type == 'default')
            {
                $products = Product::where('category_id', $category_id)->get();
            }
            else if ($sort_type == 'cost')
            {
                $products = Product::where('category_id', $category_id)->orderBy('cost', $order)->get();
            }
            else if ($sort_type == 'name')
            {
                $products = Product::where('category_id', $category_id)->orderBy('name', $order)->get();
            }
            /*
            else if ($sort_type == 'year')
            {
                $products = Product::where('category_id', $category_id)->orderBy('year', $order)->get();
            }
            */
            
        }
        else
        {
            if($sort_type == 'default')
            {
                $products = Product::all();
            }
            else if ($sort_type == 'cost')
            {
                $products = Product::orderBy('cost', $order)->get();
            }
            else if ($sort_type == 'name')
            {
                $products = Product::orderBy('name', $order)->get();
            }
            /*
            else if ($sort_type == 'year')
            {
                $products = Product::orderBy('year', $order)->get();
            }
            */
        }


        $categories = Category::all();
        
        $bucket = session('bucket', []);
        foreach ($bucket as $key => $obj) {
            $bucket[$key]['object'] = Product::find($bucket[$key]['id']);
        }

        return view('catalog', compact('products', 'categories', 'category_id', 'sort_type', 'order', 'bucket'));
    }
}
