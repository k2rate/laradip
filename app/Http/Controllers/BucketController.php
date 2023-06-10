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
            // return back();
            return response()->json(['error' => 'На складе недостаточно товаров']);
        }

        if ($bucket_product_count) {
            foreach ($bucket as $key => $obj) {
                if ($obj['id'] == $product_id) {
                    $bucket[$key]['count']++;
                    break;
                }
            }

            session(compact('bucket'));
        } else {

            $basket_product = ['id' => $product->id, 'count' => 1];
            array_push($bucket, $basket_product);

            session(compact('bucket'));

            $basket_product['object'] = $product;
            $callback_id = $product->id;

            $html = view('includes.basket.product', compact('basket_product', 'callback_id'))->render();

            return response()->json(['error' => 'success', 'callback_id' => $callback_id, 'html' => $html]);
        }



        // return back();

        return response()->json(['error' => 'success']);
    }

    public function ajaxRemove(BucketRemoveRequest $req)
    {
        $data = $req->validated();

        $product_id = $data['id'];
        $product = Product::find($product_id);

        $bucket = session('bucket', null);
        if ($bucket == null) {
            // return back();
            return response()->json(['error' => 'Ваша корзина пуста']);
        }

        $removed = false;
        foreach ($bucket as $key => $obj) {
            if ($product_id == $obj['id']) {

                $bucket[$key]['count']--;
                if ($bucket[$key]['count'] <= 0) {
                    unset($bucket[$key]);
                }

                $removed = true;
                break;
            }
        }

        session(compact('bucket'));
        // return back();

        return response()->json(['error' => 'success', 'removed' => $removed]);
    }

    public function checkout()
    {
        $bucket = session('bucket', []);
        
        if (count($bucket) == 0)
        {
            session(['error' => 'Ваша корзина пуста']);
            return back();
        }          

        foreach ($bucket as $key => $obj) {
            $bucket[$key]['object'] = Product::find($bucket[$key]['id']);
        }

        $summary = 0;
        foreach ($bucket as $key => $obj) {
            $summary += $obj['object']->cost * $obj['count'];
        }

        return view('checkout', compact('bucket', 'summary'));
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

        return redirect('catalog');
    }

    public function index()
    {
        $bucket = session('bucket', []);
        return view('bucket', compact('bucket'));
    }
}