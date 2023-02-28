<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $req, $product_id) {

        $product = Product::find($product_id);
        
        return view('product', ['product' => $product]);
    }
}
