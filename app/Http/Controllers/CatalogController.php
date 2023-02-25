<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tovar;

class CatalogController extends Controller
{
    public function index()
    {
        $tovars = Tovar::all();

        session(['tovars' => $tovars]);

        return view('catalog');
    }
}
