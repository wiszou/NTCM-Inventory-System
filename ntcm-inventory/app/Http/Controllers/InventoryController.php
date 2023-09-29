<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Facades\Log;
use View;

class InventoryController extends Controller
{
    public function addItem(Request $request)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());

        $serialNum = $request->input('item-serial');

        $existingRecord = DB::table('t_itemdetails')
            ->where('serial_num', $serialNum)
            ->first();

        if ($existingRecord) {
            return response()->json(['success' => false, 'message' => 'A similar item or serial number already exists.']);
        }

        $supplier_name = $request->input('supplier-name');
        $item_category = $request->input('category');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $price = $request->input('price');
        $cpu = $request->input('item-cpu');
        $gpu = $request->input('item-gpu');
        $ram = $request->input('item-ram');
        $storage = $request->input('item-storage');
        $acquired = $request->input('item-acquired');
        $expire = $request->input('item-expired');
        $item_status = $request->input('item-status');
        $uniqueID = $this->generateItemCode();

        if ($item_status === null) {
            $item_status = "Spare";
        }

        $inventoryData = array(
            'item_id' => $uniqueID,
            'supplier_id' => $supplier_name,
            'category_id' =>  $item_category,
            'brand_id' => $brand,
            'item_status' => $item_status,
            'user_created' => $user,
            'date_created' => $currentDate,
        );

        $detailsData = array(
            'item_id' => $uniqueID,
            'model' => $model,
            'price' => $price,
            'serial_num' => $serialNum,
            'cpu' => $cpu,
            'gpu' => $gpu,
            'ram' => $ram,
            'storage' => $storage,
            'date_acquired' => $acquired,
            'date_end' => $expire,
            'user_created' => $user,
            'date_created' => $currentDate,
        );

        try {
            DB::table('t_inventory')->insert($inventoryData);
            DB::table('t_itemdetails')->insert($detailsData);
            $this->addQuantity($item_category);
            $logController = new LogController();
            $logController->sendLog("Item " . $uniqueID . " Succesfully added");
            return response()->json(['success' => true, 'message' => 'Item added successfully.']);
        } catch (\Exception $e) {
            // Log or report the actual error message
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while adding the item.']);
        }
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
    public function getUpdatedEquipment()
    {
        $category = DB::table('m_category')->get();
        return view('equipment', ['categories' => $category]);
    }


    public function editItem($itemID)
    {
        $itemData = DB::table('t_inventory')->where("item_id", $itemID)->first();
        $itemSpecs = DB::table('t_itemdetails')->where("item_id", $itemID)->first();
        $brand = DB::table('m_brand')->get();
        $category = DB::table('m_category')->get();
        $supplier = DB::table('m_supplier')->get();
        return view('edititem', ['dataitem' => $itemData, 'suppliers' => $supplier, 'categories' => $category, 'brands' => $brand, 'specs' => $itemSpecs]);
    }
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

    public function getItemSpecs($itemID)
    {       
        $items = DB::table('t_itemdetails')
            ->where('item_id', $itemID)
            ->first(); // Get all matching items

            return response()->json(['success' => true, 'specs' => $items]);
    }



    public function updateTab(request $request)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $serialNum = $request->input('item-serial');
        $id = $request->input('id');
        $supplier_name = $request->input('supplier-name');
        $item_category = $request->input('item-category');
        $brand = $request->input('item-brand');
        $model = $request->input('item-model');
        $price = $request->input('item-price');
        $item_status = $request->input('item-status');
        $cpu = $request->input('item-cpu');
        $gpu = $request->input('item-gpu');
        $ram = $request->input('item-ram');
        $storage = $request->input('item-storage');
        $acquired = $request->input('item-acquired');
        $expire = $request->input('item-expired');

        $inventoryData = array(
            'item_id' => $id,
            'supplier_id' => $supplier_name,
            'category_id' =>  $item_category,
            'brand_id' => $brand,
            'user_created' => $user,
            'item_status' => $item_status,
            'user_change' => $user,
            'date_change' => $currentDate,
        );

        $detailsData = array(
            'model' => $model,
            'price' => $price,
            'serial_num' => $serialNum,
            'date_acquired' => $acquired,
            'date_end' => $expire,
            'cpu' => $cpu,
            'gpu' => $gpu,
            'ram' => $ram,
            'storage' => $storage,
            'user_change' => $user,
            'date_change' => $currentDate,
        );


        $success = DB::table('t_inventory')
            ->where('item_id', $id)
            ->limit(1)
            ->update($inventoryData);

        $success = DB::table('t_itemdetails')
            ->where('item_id', $id)
            ->limit(1)
            ->update($detailsData);

        if ($success) {
            $logController = new LogController();
            $logController->sendLog("Item " . $id . " Succesfully updated");
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    private function addQuantity($category)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $existingQuantity = DB::table('m_category')->where('category_id', $category)->value('quantity');
        $quantity = 1;
        $quantity = $quantity += $existingQuantity;

        $dataToUpdate = array(
            'quantity' => $quantity,
            'user_change' => $user,
            'date_change' => $currentDate,
        );

        DB::table('m_category')->where('category_id', $category)->update($dataToUpdate);
    }

    public function removeItem($removeID)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $category = DB::table('t_inventory')->where('item_id', $removeID)->value('category_id');
        $existingQuantity = DB::table('m_category')->where('category_id', $category)->value('quantity');
        $quantity = 1; // Initial quantity
        $quantity = $existingQuantity -= $quantity; // Update quantity based on subtraction

        $dataToUpdate = array(
            'quantity' => $quantity,
            'user_change' => $user,
            'date_change' => $currentDate,
        );

        $itemRemove = DB::table('t_inventory')->where('item_id', $removeID)->delete();

        if ($itemRemove) {
            DB::table('m_category')->where('category_id', $category)->update($dataToUpdate);
            DB::table('t_itemdetails')->where('item_id', $removeID)->delete();
            $logController = new LogController();
            $logController->sendLog("Item " . $removeID . " Succesfully removed");
            return response()->json(['success' => true, 'message' => 'Item removed successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Item addition failed.']);
        }
    }
}
