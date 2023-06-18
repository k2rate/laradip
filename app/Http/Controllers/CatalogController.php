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
        $sort_type = $req['sort_type'];
        $order = $req['order'];

        if ($order == null)
            $order = 'asc';

        if ($category_id == 0)
            $category_id = null;

        $query = Product::query();

        if ($category_id != null)
            $query = $query->where('category_id', $category_id);

        if ($sort_type == 'cost' || $sort_type == 'name')
            $query = $query->orderBy($sort_type, $order);

        $products = $query->get();
        $categories = Category::all();

        $checkout_status = session('checkout', 'ready');
        session(['checkout' => 'ready']);

        // return htmlspecialchars(view('includes.basket', ['product' => $products[0]])->render());

        return view('catalog', compact('products', 'categories', 'category_id', 'sort_type', 'order', 'checkout_status'));
    }
}