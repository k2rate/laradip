<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;

class AdminController extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        if ($request['login'] == 'admin' && $request['password'] == 'admin77')
            session(['isAdmin' => true]);

        return redirect()->route('admin');
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
            return view('admin.panel');

        return view('admin.login');
    }
}