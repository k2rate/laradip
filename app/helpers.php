<?php

use App\Models\Product;

function basket_count() {
    $productsInBucketCount = 0;
    $bucket = session('bucket', []);
    foreach ($bucket as $key => $obj) {
        $productsInBucketCount += $bucket[$key]['count'];
    }

    return $productsInBucketCount;
}

function basket_full() {
    $bucket = session('bucket', []);
    foreach ($bucket as $key => $obj) {
        $bucket[$key]['object'] = Product::find($bucket[$key]['id']);
    }

    return $bucket;
}