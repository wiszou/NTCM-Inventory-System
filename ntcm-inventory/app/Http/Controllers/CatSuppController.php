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
            'user_change' => $user,
            'date_created' => $date,
            'date_change' => $date
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
            'category_name' => $name,
            'user_created' => $user,
            'user_change' => $user,
            'date_created' => $date,
            'date_change' => $date
        );

        DB::table('m_category')->insert($categoryData);
        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function generateInventoryID($name)
    {
        $rowCount = DB::table('m_category')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "IT-". $name . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Category-" . $formattedRowCount;
            $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function generateCategoryID($name)
    {
        $rowCount = DB::table('m_category')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = $name . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Category-" . $formattedRowCount;
            $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();
        }

        return $candidateId;
    }

    

    public function updateTable()
    {
        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();

        return view('suppandcategs', ['category' => $category, 'suppliers' => $supplier]);
    }

    public function updateAdd()
    {
        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();

        return view('newitem', ['categories' => $category, 'suppliers' => $supplier]);
    }

    
    public function removeCategory($itemCode)
    {
        DB::table('m_category')->where('', $itemCode)->delete();
        return redirect()->back()->with('success', 'Category removed successfully.');
    }

    public function removeSupplier($itemCode)
    {
        DB::table('m_supplier')->where('supplier_id', $itemCode)->delete();
        return redirect()->back()->with('success', 'Category removed successfully.');
    }
}
