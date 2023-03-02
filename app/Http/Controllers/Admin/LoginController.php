<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if ($request['login'] == 'admin' && $request['password'] == 'admin77')
        {
            session(['isAdmin' => true]);
            return redirect()->route('admin.panel');
        }
        else
        {
            return redirect()->route('admin');
        }
    }

    public function logout()
    {
        session(['isAdmin' => false]);
        return redirect()->route('admin');
    }

    public function index()
    {
        $isAdmin = session('isAdmin', false);
        if ($isAdmin)
            return redirect()->route('admin.panel');

        return view('admin.login');
    }
}