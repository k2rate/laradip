<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AboutController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->limit(5)->get(); // the oldest entry
        
        return view('about', compact('products'));
    }
}
