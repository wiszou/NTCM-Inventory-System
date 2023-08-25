<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function addItem(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
    }

    public function removeItem()
    {
    }
}
