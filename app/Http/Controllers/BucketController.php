<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


use App\Http\Requests\BucketAddRequest;
use App\Http\Requests\BucketRemoveRequest;

function getProductCount($bucket, $product_id)
{
    foreach ($bucket as $bucketElement) {
        if ($bucketElement['object']->id == $product_id)
            return $bucketElement['count'];
    }

    return 0;
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

        if ($bucket_product_count) {
            foreach ($bucket as $key => $obj) {
                if($obj['object']->id == $product_id) {
                    $bucket[$key]['count']++;
                    break;
                }
            }
        }
        else {
            array_push($bucket, ['object' => $product, 'count' => 1]);
        }

        
        session(compact('bucket'));
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
                if ($obj['count'] != 0) {
                    $bucket[$key]['count']--;
                }
                if ($bucket[$key]['count'] == 0) {
                    unset($bucket[$key]);
                }
                break;
            }
        }

        session(compact('bucket'));
        return response()->json();
    }

    public function index()
    {
        $bucket = session('bucket', []);
        return view('bucket', compact('bucket'));
    }
}