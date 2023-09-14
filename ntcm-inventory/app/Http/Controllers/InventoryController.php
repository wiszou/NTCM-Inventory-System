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

        $existingRecord = DB::table('t_inventory')
            ->where('serial_num', $serialNum)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'A similar item or serial number already exists.');
        }

        $supplier_name = $request->input('supplier-name');
        $item_category = $request->input('category');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $price = $request->input('price');
        $current_quantity = $request->input('item-quantity');
        $item_status = $request->input('item-status');

        if ($item_status === null) {
            $item_status = 0;
        }

        $data = $this->inventoryData($item_category, $brand, $model, $price, $serialNum, $current_quantity, $supplier_name, $item_status);
        DB::table('t_inventory')->insert($data);
        $this->addQuantity($current_quantity, $item_category);
        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function removeItem($removeID)
    {
        $inventoryId = $removeID; // Assuming 'id' is the correct name
        DB::table('t_inventory')->where('inventory_id', $inventoryId)->delete();
        return redirect()->back()->with('success', 'Item removed successfully.');
    }
    public function inventoryData($item_category, $brand, $model, $price, $serialNum, $current, $supplier_name, $item_status)
    {
        $uniqueID = $this->generateItemCode();
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $inventoryData = array(
            'item_id' => $uniqueID,
            'supplier_id' => $supplier_name,
            'category_id' =>  $item_category,
            'brand_id' => $brand,
            'model' => $model,
            'price' => $price,
            'serial_num' => $serialNum,
            'item_status' => $item_status,
            'current_quantity' => $current,
            'user_created' => $user,
            'date_created' => $currentDate,
        );

        return $inventoryData;
    }

    public function generateItemCode()
    {
        $currentYear = date('Y');
        $rowCount = DB::table('t_inventory')->count();
        $rowCount++;

        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);

        $id = "IT-" . $currentYear . "-" . $formattedRowCount;
        $existingItem = DB::table('t_inventory')->where('item_id', $id)->first();

        while ($existingItem) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $id = "IT-" . $currentYear . "-" . $formattedRowCount;
            $existingItem = DB::table('t_inventory')->where('item_id', $id)->first();
        }

        return $id;
    }

    public function getUpdatedInventory()
    {
        $category = DB::table('m_category')->get();
        return view('inventory', ['categories' => $category]);
    }
    // public function getUpdatedEquipment()
    // {
    //     $category = DB::table('m_category')->get();
    //     return view('equipment', ['categories' => $category]);
    // }

    public function getItemDetails($brandID, $categoryID)
    {

        try {
            // Fetch item details based on the $itemId and $category_id using the DB facade
            $items = DB::table('t_inventory')
                ->where('brand_id', $brandID)
                ->where('category_id', $categoryID)
                ->get(); // Get all matching items

            if ($items->isEmpty()) {
                // No items found, return a JSON response with an error message
                return response()->json(['success' => false, 'message' => 'Items not found'], 404);
            }

            // Return the item details as JSON response
            return response()->json(['success' => true, 'items' => $items]);
        } catch (\Exception $e) {
            // Handle exceptions and return an error JSON response
            return response()->json(['success' => false, 'message' => 'Error fetching item details'], 500);
        }
    }



    public function updateItem(Request $request, $id)
    {
        // Retrieve the item by its ID
        $item = DB::table('t_inventory')->where('item_id', $id)
            ->first(); // Get the first matching item

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        // Retrieve the data from the request
        $dataToUpdate = $request->only([
            'item_category',
            'brand',
            'model',
            'price',
            'serial_number',
            'remarks',
            'current_quantity',
            'supplier_name',
        ]);

        // Filter out any null or empty values
        $dataToUpdate = array_filter($dataToUpdate);

        if (empty($dataToUpdate)) {
            return response()->json(['message' => 'No fields to update'], 200);
        }

        // Perform the update using the update method
        DB::table('t_inventory')->where('id', $id)->update($dataToUpdate);

        return response()->json(['message' => 'Item updated successfully'], 200);
    }

    public function updateTab(request $request)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $serialNum = $request->input('item-serial');
        $inventoryID = $request->input('idid');
        $item_code = $request->input('item-code');
        $supplier_name = $request->input('supplier-name');
        $item_category = $request->input('item-category');
        $brand = $request->input('item-brand');
        $model = $request->input('item-model');
        $price = $request->input('item-price');
        $remarks = $request->input('item-remarks');
        $current_quantity = $request->input('item-currentQuantity');
        $item_status = $request->input('answer');
        $description = $request->input('item-name');

        $data = array(
            'serial_num' => $serialNum,
            'item_id' => $item_code,
            'supplier_name' => $supplier_name,
            'category' => $item_category,
            'brand' => $brand,
            'model' => $model,
            'price' => $price,
            'remarks' => $remarks,
            'current_quantity' => $current_quantity,
            'item_status' => $item_status,
            'description' => $description,
            'user_change' => $user,
            'date_change' => $currentDate,
        );
        DB::table('t_inventory')
            ->where('inventory_id', $inventoryID)  // find your inventory item by its ID
            ->limit(1)  // optional - to ensure only one record is updated
            ->update($data);

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    private function addQuantity($quantity, $category)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $existingQuantity = DB::table('m_category')->where('category_id', $category)->value('quantity');
        $quantity =  $quantity += $existingQuantity;

        $dataToUpdate = array(
            'quantity' => $quantity,
            'user_change' => $user,
            'date_change' => $currentDate,
        );

        DB::table('m_category')->where('category_id', $category)->update($dataToUpdate);
    }
}
