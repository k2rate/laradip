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

class PanelController extends Controller
{
    public function index()
    {
        $products = Product::all();



        // Storage::disk('local')->put('example.txt', 'Contents');

        return view('admin.panel', compact('products'));
    }

    public function viewProduct(Request $req, $productId)
    {
        $product = Product::find($productId);
        return view('admin.product', compact('product'));
    }

    public function editProduct(EditProductRequest $req)
    {
        $data = $req->validated();

        $product = Product::find($data['id']);
        if ($product) {
            $product->name = $data['name'];
            $product->category = $data['category'];
            $product->description = $data['description'];
            $product->cost = $data['cost'];
            $product->count = $data['count'];
            $product->country = $data['country'];
            $product->year = $data['year'];

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

        return redirect()->route('admin.panel');
    }

    public function removeCategory(RemoveCategoryRequest $req)
    {

        return redirect()->route('admin.panel');
    }
}
