<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
class CustodianController extends Controller
{
    public function getUpdatedCustodian()
    {
        $inventory = DB::table('t_inventory')->get();
        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();
        return view('custodian', ['inventory' => $inventory, 'categories' => $category, 'suppliers' => $supplier]);
    }
}