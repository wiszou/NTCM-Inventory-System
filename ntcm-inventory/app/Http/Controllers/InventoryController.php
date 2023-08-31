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
        
        $item_category = $request->input('item-category');
        $brand = $request->input('item-brand');
        $model = $request->input('item-model');
        $price = $request->input('item-price');
        $serialNum = $request->input('item-serial');
        $item_description = $request->input('item-description');
        $remarks = $request->input('item-remarks');
        $current_quantity = $request->input('item-currentQuantity');
        $min_quantity = $request->input('item-minQuantity');
        $max_quantity = $request->input('item-maxQuantity');
        $item_name = "$brand $model $serialNum";
        DB::table('m_inventory')->insert($this->inventoryData($item_code, $item_name, $item_category, $brand, $model, $price, $serialNum, $item_description, $remarks, $current_quantity, $min_quantity, $max_quantity, $supplier_name));
    }

    public function removeItem($itemCode)
    {
        DB::table('m_inventory')->where('item_id', $itemCode)->delete();

        // You can return a response or redirect here
    }

    public function updateItem()
    {
    }

    public function getAllItems()
    {
        $inventory = DB::table('m_inventory')->get();

        return view('inventory', ['inventory' => $inventory]);
    }

    public function getUpdatedInventory()
    {
        $inventory = DB::table('m_inventory')->get();
        return response()->json(['inventory' => $inventory]);
    }

    public function inventoryData($item_code, $item_name, $item_category, $brand, $model, $price, $serialNum, $description, $remarks, $current, $min, $max, $supplier_name)
    {
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $uniqueID = $this->generateItemCode();
        $user = session()->get('user_name');
        $inventoryData = array(
            'inventory_id' => $uniqueID,
            'item_id' => $item_code,
            'supplier_name' => $supplier_name,
            'item_name' => $item_name,
            'category' =>  $item_category,
            'brand' => $brand,
            'model' => $model,
            'price' => $price,
            'serial_num' => $serialNum,
            'description' => $description,
            'remarks' => $remarks,
            'item_status' => '0',
            'current_quantity' => $current,
            'min_quantity' => $min,
            'max_quantity' => $max,
            'user_created' => $user,
            'date_created' => $currentDate,
            'user_change' => $user,
            'date_change' => $currentDate
        );

        return $inventoryData;
    }

    public function generateItemCode()
    {
        $rowCount = DB::table('m_inventory')->count();
        $rowCount++;
        return $rowCount;
    }
}
