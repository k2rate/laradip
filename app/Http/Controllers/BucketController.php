<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Http\Requests\BucketAddRequest;
use App\Http\Requests\BucketRemoveRequest;
use App\Http\Requests\CheckoutSubmitRequest;

function getProductCount($bucket, $product_id)
{
    foreach ($bucket as $bucketElement) {
        if ($bucketElement['id'] == $product_id)
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
            return back();
            // return response()->json(['error' => 'На складе недостаточно товаров']);
        }

        if ($bucket_product_count) {
            foreach ($bucket as $key => $obj) {
                if($obj['id'] == $product_id) {
                    $bucket[$key]['count']++;
                    break;
                }
            }
        }
        else {
            array_push($bucket, ['id' => $product->id, 'count' => 1]);
        }

        
        session(compact('bucket'));
        return back();

        // return response()->json(['error' => 'success']);
    }

    public function ajaxRemove(BucketRemoveRequest $req)
    {
        $data = $req->validated();

        $bucket = session('bucket', null);
        if ($bucket == null)
        {
            return back();
            // return response()->json();
        }
            

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
        return back();

        // return response()->json();
    }

    public function checkout()
    {
        $bucket = session('bucket', []);
        foreach ($bucket as $key => $obj) {
            $bucket[$key]['object'] = Product::find($bucket[$key]['id']);
        }

        $summary = 0;
        foreach ($bucket as $key => $obj) {
            $summary += $obj['object']->cost * $obj['count'];
        }

        $status = session('checkout', 'ready');
        session(['checkout' => 'ready']);

        return view('checkout', compact('bucket', 'summary', 'status'));
        // return back();
    }

    public function checkoutSubmit(CheckoutSubmitRequest $req)
    {
        $data = $req->validated();
        $bucket = session('bucket', []);
        $jsbucket = json_encode($bucket);

        $bucket = session('bucket', []);
        $data['bucket'] = $jsbucket;

        Checkout::firstOrCreate($data);
        
        session(['checkout' => 'confirmed']);
        session(['bucket' => []]);

        return back();
    }

    public function index()
    {
        $bucket = session('bucket', []);
        return view('bucket', compact('bucket'));
    }
}