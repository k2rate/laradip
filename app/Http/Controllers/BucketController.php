<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


use App\Http\Requests\BucketAddRequest;
use App\Http\Requests\BucketRemoveRequest;

function getProductCount($bucket, $product_id)
{
    $counter = 0;
    foreach ($bucket as $product) {
        if ($product->id == $product_id)
            $counter++;
    }

    return $counter;
}

class BucketController extends Controller
{
    public function ajaxAdd(BucketAddRequest $req)
    {
        $data = $req->validated();

        $product_id = $data['id'];
        $product = Product::find($product_id);

        $bucket = session('bucket', []);
        $bucket_product_count = getProductCount($bucket, $product_id);

        if ($bucket_product_count >= $product->count) {
            return response()->json(['error' => 'На складе недостаточно товаров']);
        }

        array_push($bucket, $product);
        session(['bucket' => $bucket]);

        return response()->json(['error' => 'success']);
    }

    public function ajaxRemove(BucketRemoveRequest $req)
    {
        $data = $req->validated();

        $bucket = session('bucket', null);
        if ($bucket == null)
            return response()->json();

        foreach ($bucket as $key => $obj) {
            if ($data['index'] == $key) {
                unset($bucket[$key]);
                break;          
            }
        }
        
        session(['bucket' => $bucket]);
        return response()->json();
    }

    public function index()
    {
        $products = session('bucket', []);
        return view('bucket', ['products' => $products]);
    }
}