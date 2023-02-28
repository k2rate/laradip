<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

function getproductCount($bucket, $product_id)
{
    $counter = 0;
    for ($i = 0; $i != sizeof($bucket); $i++) {
        if ($bucket[$i]->id == $product_id) {
            $counter++;
        }
    }

    return $counter;
}

class BucketController extends Controller
{
    public function ajaxAdd(Request $req)
    {
        $product_id = $req['product_id'];
        $product = Product::find($product_id);

        $bucket = session('bucket', []);
        $bucket_product_count = getproductCount($bucket, $product_id);

        if ($bucket_product_count >= $product->count) {
            return response()->json(['error' => 'На складе недостаточно товаров']);
        }

        array_push($bucket, $product);
        session(['bucket' => $bucket]);

        return response()->json(['error' => 'success']);
    }

    public function index()
    {
        $arr = session('bucket');
        if ($arr == null)
            $arr = [];

        $products = [];
        foreach ($arr as $product_id)
        {
            array_push($products, Product::find($product_id));
        }

        return view('bucket', ['products' => $products]);
    }
}
