<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BucketController extends Controller
{
    public function add(Request $req)
    {
        $tovar_id = $req['tovar_id'];

        $bucket = session('bucket');
        if($bucket == null)
        {
            $bucket = [$tovar_id];
        }
        else
        {
            array_push($bucket, $tovar_id);
        }
        
        return redirect()->to('bucket');
    }

    public function index()
    {
        $arr = session('bucket');
        if($arr == null)
            $arr = [];
        
        return view('bucket', ['bucket' => $arr]);
    }
}
