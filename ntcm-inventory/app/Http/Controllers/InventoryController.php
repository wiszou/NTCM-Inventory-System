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

    public function updateItem(Request $request, $id)
    { {
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

    public function getUpdatedInventory()
    {
        $inventory = DB::table('m_inventory')->get();
        return response()->json(['inventory' => $inventory]);
    }

    public function inventoryData($item_code, $item_name, $item_category, $brand, $model, $price, $serialNum, $description, $remarks, $current, $min, $max, $supplier_name)
    {
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
            'date_created' => getDate(),
            'user_change' => $user,
            'date_change' => getDate()
        );

        return $inventoryData;
    }

    public function generateItemCode()
    {
        $rowCount = DB::table('m_inventory')->count();
        $rowCount++;
        return $rowCount;
    }

    public function getDate()
    {
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        return $currentDate;
    }
}
