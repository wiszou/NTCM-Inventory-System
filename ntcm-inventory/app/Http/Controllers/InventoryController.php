<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade

class InventoryController extends Controller
{
    public function addItem(Request $request)
    {
        $item_code = $request->input('item-code');
        $supplier_name = $request->input('supplier-name');
        $item_name = $request->input('item_name');
        $item_category = $request->input('item-category');
        $brand = $request->input('item-brand');
        $model = $request->input('item-model');
        $price = $request->input('item-price');
        $serialNum = $request->input('item-serial');
        $item_description = $request->input('item-description');
        $remarks = $request->input('item-remarks');
        $current_quantity = $request->input('item-currentQuantity');
        $min_quantity = $request->input('item-minQuantity');
        $max_quantity = $request->input('item-minQuantity');
        DB::table('m_inventory')->insert($this->inventoryData($item_code,$item_name,$item_category,$brand,$model,$price,$serialNum,$item_description,$remarks,$current_quantity,$min_quantity,$max_quantity,$supplier_name));
        
    }

    public function removeItem(Request $request)
    {
        $item_code = $request->input('item-code');
        DB::table('m-inventory')->where('item_code', $item_code)->delete();
    }

    public function updateItem()
    {
        
    }

    public function inventoryData($item_code, $item_name, $item_category, $brand, $model, $price, $serialNum, $description, $remarks, $current, $min, $max, $supplier_name)
    {
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $uniqueID = $this->generateItemCode();
        
        $inventoryData = array(
            'invetory_id' => $uniqueID,
            'item_code' => $item_code,
            'supplier_name' => $supplier_name,
            'item_name' => $item_name,
            'item_category' =>  $item_category,
            'brand' => $brand,
            'model' => $model,
            'price' => $price,
            'serial_num' => $serialNum,
            'description' => $description,
            'remarks' => $remarks,
            'item_status' => 'Stock',
            'current_quantity' => $current,
            'min_quantity' => $min, 
            'max_quantity' => $max,
            'user_created' => session()->get('user_name'),
            'date_created' => $currentDate,
            'user_change' => session()->get('user_name'),
            'date_change' => $currentDate
        );

        return $inventoryData;
    }

    public function generateItemCode() {
        $rowCount = DB::table('m-inventory')->count();
        $rowCount++;
        return $rowCount;
    }
}
