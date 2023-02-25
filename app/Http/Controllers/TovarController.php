<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tovar;

class TovarController extends Controller
{
    public function index(Request $req, $tovar_id) {

        $tovar = Tovar::find($tovar_id);

        session(['tovar' => $tovar]);

        return view('tovar');
    }
}
