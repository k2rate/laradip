<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\EditProductRequest;
use App\Http\Requests\Admin\EditProductImageRequest;
use App\Http\Requests\Admin\DeleteProductRequest;

use App\Http\Requests\Admin\AddCategoryRequest;
use App\Http\Requests\Admin\DeleteCategoryRequest;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Checkout;

class PanelController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $checkouts_elo = Checkout::all();
        $checkouts = [];
        foreach ($checkouts_elo as $elo) {
            $checkout['data'] = $elo;
            
            $summary = 0;
            $bucket = json_decode($elo['bucket'], true);
            foreach ($bucket as $key => $obj) {
                $bucket[$key]['object'] = Product::find($bucket[$key]['id']);
                $summary += $bucket[$key]['count'];
            }



            $checkout['bucket'] = $bucket;
            $checkout['summary'] = $summary;

            array_push($checkouts, $checkout);
        }

       

        return view('admin.panel', compact('products', 'categories', 'checkouts'));
    }

    public function viewProduct(Request $req, $productId)
    {
        $product = Product::find($productId);
        $categories = Category::all();

        return view('admin.product', compact('product', 'categories'));
    }

    public function editProduct(EditProductRequest $req)
    {
        $data = $req->validated();

        $product = Product::find($data['id']);
        if ($product) {
            $product->name = $data['name'];
            $product->category_id = $data['category_id'];
            $product->description = $data['description'];
            $product->cost = $data['cost'];
            $product->count = $data['count'];
            // $product->country = $data['country'];
            // $product->year = $data['year'];

            $product->save();
        }

        return back();
    }

    public function editProductImage(EditProductImageRequest $req)
    {
        $data = $req->validated();
        $product = Product::find($data['id']);
        if ($product) {
            $product->image = 'storage/' . Storage::put('', $data['image']);
            $product->save();
        }

        return back();
    }

    public function storeProduct(StoreProductRequest $req)
    {
        $data = $req->validated();
        $data['image'] = Storage::put('', $data['image']);
        $data['image'] = 'storage/' . $data['image'];

        $model = Product::firstOrCreate($data);

        return redirect()->route('admin.panel');
    }

    public function deleteProduct(DeleteProductRequest $req)
    {
        $data = $req->validated();
        Product::find($data['id'])->delete();

        return redirect()->route('admin.panel');
    }

    public function addCategory(AddCategoryRequest $req)
    {
        $data = $req->validated();
        Category::firstOrCreate($data);
        return redirect()->route('admin.panel');
    }

    public function deleteCategory(DeleteCategoryRequest $req)
    {
        $data = $req->validated();
        
        Category::find($data['id'])->delete();
        return redirect()->route('admin.panel');
    }

    public function finishCheckout(Request $req)
    {
        $id = $req['id'];
        Checkout::where('id', $id)->delete();

        return back();
    }
}
