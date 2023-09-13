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
            return redirect()->back()->with('error', 'Supplier with this name already exists.');
        }

        $id =  $this->generatesupplierID();
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());
        $supplierData = array(
            'supplier_id' => $id,
            'name' => $name,
            'contact' => $contact,
            'user_created' => $user,
            'date_created' => $date,
        );

        DB::table('m_supplier')->insert($supplierData);
        return redirect()->back()->with('success', 'Supplier added successfully.');
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
        // Check if a category with the same name already exists
        $existingCategory = DB::table('m_category')
            ->where('category_name', $name)
            ->first();

        if ($existingCategory) {
            // A category with the same name already exists, handle accordingly (e.g., show an error message).
            return redirect()->back()->with('error', 'Category with this name already exists.');
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
            'stock_actual' => 0,
            'category_name' => $name,
            'user_created' => $user,
            'date_created' => $date,
        );

        DB::table('m_category')->insert($categoryData);
        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function addBrand (Request $request)
    {
        $name = $request->input('name');
        // Check if a category with the same name already exists
        $existingCategory = DB::table('m_brand')
            ->where('name', $name)
            ->first();

        if ($existingCategory) {
            // A category with the same name already exists, handle accordingly (e.g., show an error message).
            return redirect()->back()->with('error', 'Category with this name already exists.');
        }

        $brand_id = $this->generateBrandID($name);
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        $categoryData = array(
            'brand_id' => $brand_id,
            'name' => $name,
            'quantity' => 0,
            'user_created' => $user,
            'date_created' => $date,
        );

        DB::table('m_brand')->insert($categoryData);
        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function generateInventoryID($name)
    {
        $rowCount = DB::table('m_category')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "IT-". $name . "-" . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "IT-". $name . "-" . $formattedRowCount;
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

    

    public function updateTable()
    {
        $supplier = DB::table('m_supplier')->get();
        $brand = DB::table('m_brand')->get();

        return view('suppandcategs', ['brand' => $brand, 'suppliers' => $supplier]);
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
        DB::table('m_category')->where('category_id', $itemCode)->delete();
        return redirect()->back()->with('success', 'Category removed successfully.');
    }

    public function removeSupplier($itemCode)
    {
        DB::table('m_supplier')->where('supplier_id', $itemCode)->delete();
        return redirect()->back()->with('success', 'Supplier removed successfully.');
    }

    public function removeBrand($itemCode)
    {
        DB::table('m_brand')->where('brand_id', $itemCode)->delete();
        return redirect()->back()->with('success', 'Brand removed successfully.');
    }
}
