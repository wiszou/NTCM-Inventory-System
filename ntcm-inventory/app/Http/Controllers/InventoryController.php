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

        // Check if a record with the same serial number or item name already exists
        $existingRecord = DB::table('m_inventory')
            ->where('serial_num', $serialNum)
            ->orWhere('item_id', $item_code)
            ->first();

        if ($existingRecord) {
            // Handle the case where a similar record already exists
            return redirect()->back()->with('error', 'A similar item or serial number already exists.');
        }

        // If no similar record exists, proceed to add the new item
        $item_code = $request->input('item-code');
        $supplier_name = $request->input('supplier-name');
        $item_category = $request->input('item-category');
        $brand = $request->input('item-brand');
        $model = $request->input('item-model');
        $price = $request->input('item-price');
        $item_description = $request->input('item-description');
        $remarks = $request->input('item-remarks');
        $current_quantity = $request->input('item-currentQuantity');
        $min_quantity = $request->input('item-minQuantity');
        $max_quantity = $request->input('item-maxQuantity');
        $item_name = $item_category . "-" . $model . "-" . $serialNum;

        $data = $this->inventoryData($item_code, $item_name, $item_category, $brand, $model, $price, $serialNum, $item_description, $remarks, $current_quantity, $min_quantity, $max_quantity, $supplier_name);
        DB::table('m_inventory')->insert($data);

        // Redirect or provide a success message here
        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function removeItem($itemCode)
    {
        DB::table('m_inventory')->where('item_id', $itemCode)->delete();

        // You can return a response or redirect here
    }

    public function inventoryData($item_code, $item_name, $item_category, $brand, $model, $price, $serialNum, $description, $remarks, $current, $min, $max, $supplier_name)
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
            'description' => $description,
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

        // Format $rowCount with leading zeros (e.g., "0001", "0010", "0100")
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);

        $id = $category . $currentYear . $formattedRowCount;
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
        $item_description = $request->input('item-description');
        $remarks = $request->input('item-remarks');
        $current_quantity = $request->input('item-currentQuantity');
        $min_quantity = $request->input('item-minQuantity');
        $max_quantity = $request->input('item-maxQuantity');

        // Update the item's attributes if the variables are not empty
        $dataToUpdate = [];

        if (!empty($item_code)) {
            $dataToUpdate['item_code'] = $item_code;
        }
        if (!empty($item_category)) {
            $dataToUpdate['supplier_name'] = $item_category;
        }
        if (!empty($brand)) {
            $dataToUpdate['supplier_name'] = $brand;
        }
        if (!empty($model)) {
            $dataToUpdate['supplier_name'] = $model;
        }
        if (!empty($price)) {
            $dataToUpdate['supplier_name'] = $price;
        }
        if (!empty($serialNum)) {
            $dataToUpdate['supplier_name'] = $serialNum;
        }
        if (!empty($item_description)) {
            $dataToUpdate['supplier_name'] = $item_description;
        }
        if (!empty($remarks)) {
            $dataToUpdate['supplier_name'] = $remarks;
        }
        if (!empty($current_quantity)) {
            $dataToUpdate['supplier_name'] = $current_quantity;
        }
        if (!empty($min_quantity)) {
            $dataToUpdate['supplier_name'] = $min_quantity;
        }
        if (!empty($max_quantity)) {
            $dataToUpdate['supplier_name'] = $max_quantity;
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
