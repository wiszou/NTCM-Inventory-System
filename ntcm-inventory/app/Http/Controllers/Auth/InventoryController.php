<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function addItem(Request $request)
    {
        $item_name = $request->input('item-name');
        $item_code = $request->input('item-code');
        $item_description = $request->input('item-code');
    }

    public function removeItem()
    {
    }
}
