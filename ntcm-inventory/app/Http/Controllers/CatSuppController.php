<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CatSuppController extends Controller
{
    public function addSupplier(Request $request)
    {
        $name = $request->input('supplier-name');
        $contact = $request->input('contact');
        // Check if a supplier with the same name already exists
        $existingSupplier = DB::table('m_supplier')
            ->where('name', $name)
            ->first();

        if ($existingSupplier) {
            // A supplier with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'A similar Name already exists.']);
        }

        $id =  $this->generatesupplierID();
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());
        $firstIteration = true;
        try {
            // // Insert brand associations into m_supplierbrand table
            // foreach ($selectedBrands as $brandName) {
            //     if ($firstIteration) {
            //         $firstIteration = false;
            //         continue; // Skip the first iteration
            //     }

            //     DB::table('m_supplierbrand')->insert([
            //         'supplier_id' => $id,
            //         'brand_id' => $brandName,
            //     ]);

            //     // Your logic for subsequent iterations goes here
            //     // $brandName contains the value for the current iteration
            // }

            // Insert supplier data into m_supplier table
            DB::table('m_supplier')->insert([
                'supplier_id' => $id,
                'name' => $name,
                'contact' => $contact,
                'user_created' => $user,
                'date_created' => $date,
            ]);

            $logController = new LogController();
            $logController->sendLog("Supplier " . $id . " Successfully added");
            return response()->json(['success' => true, 'message' => 'Supplier added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Can\'t add supplier']);
        }
    }


    public function generatesupplierID()
    {
        $rowCount = DB::table('m_supplier')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "ID-Supplier-" . $formattedRowCount;

        $existingSuppllier = DB::table('m_supplier')->where('supplier_id', $candidateId)->first();

        while ($existingSuppllier) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Supplier-" . $formattedRowCount;
            $existingSuppllier = DB::table('m_supplier')->where('supplier_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function addCategory(Request $request)
    {
        $name = $request->input('name');
        $stock = $request->input('stock');
        $specs = 0;
        $specs = $request->input('specs');
        // Check if a category with the same name already exists
        $existingCategory = DB::table('m_category')
            ->where('category_name', $name)
            ->first();

        if ($existingCategory) {
            // A category with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'Category name already exist.']);
        }

        $id =  $this->generateInventoryID($name);
        $categId = $this->generateCategoryID($name);
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        $categoryData = array(
            'inventory_id' => $id,
            'category_id' => $categId,
            'stock_req' => $stock,
            'quantity' => 0,
            'specs' => $specs,
            'category_name' => $name,
            'user_created' => $user,
            'date_created' => $date,
        );

        $categoryAddedSuccessfully = DB::table('m_category')->insert($categoryData);
        if ($categoryAddedSuccessfully) {
            $logController = new LogController();
            $logController->sendLog("Category " . $categId . " Succesfully added");
            return response()->json(['success' => true, 'message' => 'Category added successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Category addition failed.']);
        }
    }

    public function addBrand(Request $request)
    {
        $name = $request->input('name');
        // Check if a category with the same name already exists
        $existingCategory = DB::table('m_brand')
            ->where('name', $name)
            ->first();

        if ($existingCategory) {
            // A category with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'Similar brand name already exist']);
        }

        $brand_id = $this->generateBrandID($name);
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        $categoryData = array(
            'brand_id' => $brand_id,
            'name' => $name,
            'user_created' => $user,
            'date_created' => $date,
        );

        try {
            DB::table('m_brand')->insert($categoryData);
            $logController = new LogController();
            $logController->sendLog("Brand " . $brand_id . " Succesfully added");
            return response()->json(['success' => true, 'message' => 'Brand added succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant add brand']);
        }
    }

    public function generateInventoryID($name)
    {
        $rowCount = DB::table('m_category')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "IT-" . $name . "-" . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "IT-" . $name . "-" . $formattedRowCount;
            $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function generateCategoryID($name)
    {
        $rowCount = DB::table('m_category')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "ID-Category-" . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Category-" . $formattedRowCount;
            $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function generateBrandID($name)
    {
        $rowCount = DB::table('m_category')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "ID-Brand-" . $formattedRowCount;

        $existingCategory = DB::table('m_brand')->where('brand_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Brand-" . $formattedRowCount;
            $existingCategory = DB::table('m_brand')->where('brand_id', $candidateId)->first();
        }

        return $candidateId;
    }



    public function updateTable1()
    {

        $brand = DB::table('m_brand')->get();

        return view('brands', ['brand' => $brand]);
    }

    public function updateTable2()
    {

        $supplier = DB::table('m_supplier')->get();

        return view('suppliers', ['suppliers' => $supplier]);
    }

    public function updateCateg()
    {
        $category = DB::table('m_category')->get();

        return view('categories', ['category' => $category]);
    }

    public function updateAdd()
    {
        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();
        $brand = DB::table('m_brand')->get();

        return view('newitem', ['categories' => $category, 'suppliers' => $supplier, 'brand' => $brand]);
    }


    public function removeCategory($itemCode)
    {
        try {
            DB::table('m_category')->where('category_id', $itemCode)->delete();
            $logController = new LogController();
            $logController->sendLog("Category " . $itemCode . " Succesfully Deleted");
            return response()->json(['success' => true, 'message' => 'Item removed succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant remove item']);
        }
    }

    public function removeSupplier($itemCode)
    {

        try {
            DB::table('m_supplier')->where('supplier_id', $itemCode)->delete();
            $logController = new LogController();
            $logController->sendLog("Supplier " . $itemCode . " Succesfully Deleted");
            return response()->json(['success' => true, 'message' => 'Item removed succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant remove item']);
        }
    }

    public function removeBrand($itemCode)
    {
        try {
            DB::table('m_brand')->where('brand_id', $itemCode)->delete();
            $logController = new LogController();
            $logController->sendLog("Brand " . $itemCode . " Succesfully Deleted");
            return response()->json(['success' => true, 'message' => 'Item removed succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant remove item']);
        }
    }

    public function checkBrand($categoryID)
    {

        $brandIds = DB::table('t_inventory')
            ->where('category_id', $categoryID)
            ->pluck('brand_id');

        $brands = DB::table('m_brand')
            ->whereIn('brand_id', $brandIds)
            ->get();

        return view('itemheader', ['brands' => $brands, 'category_id' => $categoryID]);
    }
}
