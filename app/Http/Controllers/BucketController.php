<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tovar;

function getTovarCount($bucket, $tovar_id)
{
    $counter = 0;
    for ($i = 0; $i != sizeof($bucket); $i++) {
        if ($bucket[$i]->id == $tovar_id) {
            $counter++;
        }
    }

    return $counter;
}

class BucketController extends Controller
{
    public function ajaxAdd(Request $req)
    {
        $tovar_id = $req['tovar_id'];
        $tovar = Tovar::find($tovar_id);

        $bucket = session('bucket', []);
        $bucket_tovar_count = getTovarCount($bucket, $tovar_id);

        if ($bucket_tovar_count >= $tovar->count) {
            return response()->json(['error' => 'На складе недостаточно товаров']);
        }

        array_push($bucket, $tovar);
        session(['bucket' => $bucket]);

        return response()->json(['error' => 'success']);
    }

    public function index()
    {
        $arr = session('bucket');
        if ($arr == null)
            $arr = [];

        return view('bucket', ['bucket' => $arr]);
    }
}
