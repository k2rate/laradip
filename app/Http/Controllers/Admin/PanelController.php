<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class PanelController extends Controller
{
    public function index()
    {
        // Storage::disk('local')->put('example.txt', 'Contents');

        return view('admin.panel');
    }
    
    public function storeProduct(StoreProductRequest $req)
    {
        $data = $req->validated();
        $data['image'] = Storage::put('', $data['image']);
        $data['image'] = 'storage/'.$data['image'];

        $model = Product::firstOrCreate($data);

        // $url = Storage::url($data['image']);
        // dd($data['image']);

        /*
        'name' => 'required|string',
            'category' => 'required|string',
            'cost' => 'required|integer',
            'count' => 'required|integer',
            'country' => 'required|string',
            'year' => 'required|integer',
            'model' => 'required|string',
            'image' => 'required|file'
        */


        

        return redirect()->route('admin.panel');
    }
}