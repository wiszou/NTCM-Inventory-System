<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use View;

class InventoryController extends Controller
{
    public function addItem(Request $request)
    {
        $serialNum = $request->input('item-serial');
        $item_code = $request->input('item-code');

        $existingRecord = DB::table('m_inventory')
            ->where('serial_num', $serialNum)
            ->orWhere('item_id', $item_code)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'A similar item or serial number already exists.');
        }

        $item_code = $request->input('item-code');
        $supplier_name = $request->input('supplier-name');
        $item_category = $request->input('item-category');
        $brand = $request->input('item-brand');
        $model = $request->input('item-model');
        $price = $request->input('item-price');
        $remarks = $request->input('item-remarks');
        $current_quantity = $request->input('item-currentQuantity');
        $min_quantity = $request->input('item-minQuantity');
        $max_quantity = $request->input('item-maxQuantity');
        $item_name = $item_category . "-" . $model . "-" . $serialNum;

        $data = $this->inventoryData($item_code, $item_name, $item_category, $brand, $model, $price, $serialNum, $remarks, $current_quantity, $min_quantity, $max_quantity, $supplier_name);
        DB::table('m_inventory')->insert($data);

        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function removeItem($itemCode)
    {
        DB::table('m_inventory')->where('item_id', $itemCode)->delete();

    }

    public function inventoryData($item_code, $item_name, $item_category, $brand, $model, $price, $serialNum, $remarks, $current, $min, $max, $supplier_name)
    {
        $uniqueID = $this->generateItemCode($item_category);

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
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
            'remarks' => $remarks,
            'item_status' => 1,
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

    public function generateItemCode($category)
    {
        $currentYear = date('Y');
        $rowCount = DB::table('m_inventory')->count();
        $rowCount++;

        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);

        $id = $category . $currentYear . $formattedRowCount;
        $existingItem = DB::table('m_inventory')->where('inventory_id', $id)->first();

        while ($existingItem) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $id = $category . $currentYear . $formattedRowCount;
            $existingItem = DB::table('m_inventory')->where('inventory_id', $id)->first();
        }

        return $id;
    }

    public function getUpdatedInventory()
    {
        $inventory = DB::table('m_inventory')->get();
        return view('inventory', ['inventory' => $inventory]);
    }



    public function updateItem(Request $request, $id)
    {
        $item_code = $request->input('item-code');
        $supplier_name = $request->input('supplier-name');
        $item_category = $request->input('item-category');
        $brand = $request->input('item-brand');
        $model = $request->input('item-model');
        $price = $request->input('item-price');
        $serialNum = $request->input('item-serial');
        $remarks = $request->input('item-remarks');
        $current_quantity = $request->input('item-currentQuantity');
        $min_quantity = $request->input('item-minQuantity');
        $max_quantity = $request->input('item-maxQuantity');

        $dataToUpdate = [];

        if (!empty($item_code)) {
            $dataToUpdate['item_code'] = $item_code;
        }
        if (!empty($item_category)) {
            $dataToUpdate['item_category'] = $item_category;
        }
        if (!empty($brand)) {
            $dataToUpdate['brand'] = $brand;
        }
        if (!empty($model)) {
            $dataToUpdate['model'] = $model;
        }
        if (!empty($price)) {
            $dataToUpdate['price'] = $price;
        }
        if (!empty($serialNum)) {
            $dataToUpdate['serialNum'] = $serialNum;
        }
        if (!empty($remarks)) {
            $dataToUpdate['remarks'] = $remarks;
        }
        if (!empty($current_quantity)) {
            $dataToUpdate['current_quantity'] = $current_quantity;
        }
        if (!empty($min_quantity)) {
            $dataToUpdate['min_quantity'] = $min_quantity;
        }
        if (!empty($max_quantity)) {
            $dataToUpdate['max_quantity'] = $max_quantity;
        }

        if (empty($dataToUpdate)) {
            return response()->json(['message' => 'No fields to update'], 200);
        }

        // Perform the update using the DB facade
        DB::table('m_inventory')
            ->where('id', $id)
            ->update($dataToUpdate);

        return response()->json(['message' => 'Item updated successfully'], 200);
    }
}
