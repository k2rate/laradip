<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    /*

                'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'comment' => 'nullable|string',

            'kv' => 'nullable|integer',
            'dm' => 'nullable|integer',
            'pd' => 'nullable|integer',
            'et' => 'nullable|integer',

            'payway' => 'required|integer',
            'cardnumber' => 'nullable|string',
            'expiry' => 'nullable|string',
            'cvv' => 'nullable|string'

    */

    protected $fillable = ['name', 'address', 'phone', 'email', 'comment', 'kv', 'dm', 'pd', 'et', 'payway', 'bucket'];
}
