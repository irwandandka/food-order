<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function user()
    {
        return view('admin.users');
    }

    public function order()
    {
        return view('admin.orders');
    }

    public function payment()
    {
        return view('admin.payments');
    }

    public function add()
    {
        return view('admin.form');
    }

    public function edit(Menu $menu)
    {
        return view('admin.form', ['data' => $menu]);
    }
}
