<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Facades\Log;

class CustodianController extends Controller
{
    public function getUpdatedCustodian()
    {
        $inventory = DB::table('t_inventory')->get();
        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();
        return view('custodian', ['inventory' => $inventory, 'categories' => $category, 'suppliers' => $supplier]);
    }

    public function getUpdatedCustodian1()
    {
        $inventory = DB::table('t_inventory')->get();
        $itemdetails = DB::table('t_itemdetails')->get();
        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();
        $custodian = DB::table('t_custodian')->get();
        $employee = DB::table('m_employee')->get();
        return view('custodianCreate', ['inventory' => $inventory, 'categories' => $category, 'suppliers' => $supplier, 'details' => $itemdetails, 'custodian' => $custodian, 'employees' => $employee]);
    }

    public function generateID()
    {
        $rowCount = DB::table('t_custodian')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "IT-" . "CSF" . "-" . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "IT-" . "CSF" . "-" . $formattedRowCount;
            $existingCategory = DB::table('t_custodian')->where('custodian_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function createCustodian(Request $request)
    {

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        $currentDate = date('d-F-Y');
        $custodianID = $this->generateID();
        $handlerName = $request->input('handlerName');
        $handlerName2 = $request->input('handlerName2');
        $description = $request->input('description');
        $type = $request->input('type');
        $noted = $request->input('noted');
        $issued = $request->input('issued');
        $items = $request->input('itemArray');

        $handlerName2 = ($handlerName2 === 'none') ? null : $handlerName2;

        if ($type == "none") {
            return response()->json(['success' => false, 'message' => 'Please select proper custodian type']);
        };

        if ($items == "none") {
            return response()->json(['success' => false, 'message' => 'Please select an item']);
        };

        $description = "hahah";

        $custodianData = array(
            'custodian_id' => $custodianID,
            'name' => $handlerName,
            'name2' => $handlerName2,
            'noted' => $noted,
            'issued' => $issued,
            'description' => $description,
            'start_date' => $currentDate,
            'status' => 0,
            'deleted' => "false",
            'type' => $type,
            'items' => $items,
            'user_created' => $user,
            'date_created' => $date,
        );


        try {
            $this->updateItem($items, $type, $custodianID);
            DB::table('t_custodian')->insert($custodianData);
            $logController = new LogController();
            $logController->sendLog("Custodian Form " . $custodianID . " Succesfully added");
            // $this->toPrint($custodianID);
            return response()->json(['success' => true, 'message' => 'Item added successfully.']);
        } catch (\Exception $e) {
            error_log(json_encode($items));
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while adding the item.']);
        }
    }

    function updateItem($items, $type, $id)
    {

        if ($type == "Deploy") {
            $type = "Deployed";  // Use = instead of ==
        }

        if ($type == "Borrow") {
            $type = "Borrowed";  // Use = instead of ==
        }

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        $itemsArray = json_decode($items);
        foreach ($itemsArray as $item) {

            $itemData = array(
                'item_status' => $type,
                'user_change' => $user,
                'date_change' => $date,
                'custodian_id' => $id
            );

            DB::table('t_inventory')->where('item_id', $item)->update($itemData);
            $result = DB::table('t_inventory')->where('item_id', $item)->first();
            if ($result) {
                $category_id = $result->category_id;
                $category = array(
                    'user_change' => $user,
                    'date_change' => $date,
                );
                DB::table('m_category')->where('category_id', $category_id)->update($category);
            } else {
                return response()->json(['success' => false, 'message' => 'array aasd']);
            }
        }
    }

    public function generateIDEmployee()
    {
        $rowCount = DB::table('m_employee')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "Employee" . "-" . $formattedRowCount;

        $existingCategory = DB::table('m_employee')->where('employee_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "Employee" . "-" . $formattedRowCount;
            $existingCategory = DB::table('m_employee')->where('employee_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function addEmployee(Request $request)
    {
        $name = $request->input('name');
        $position = $request->input('position');
        $department = $request->input('department');
        $id = $this->generateIDEmployee();

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());

        $data = array(
            'name' => $name,
            'position' => $position,
            'department' => $department,
            "employee_id" => $id,
            'user_created' => $user,
            'date_created' => $currentDate,
        );

        try {
            DB::table('m_employee')->insert($data);
            $logController = new LogController();
            $logController->sendLog("Employee " . $id . " Succesfully added");
            return response()->json(['success' => true, 'message' => 'Employee added successfully.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while adding the item.']);
        }
    }

    public function toPrint($custodianID)
    {
        $custodian = DB::table('t_custodian')->where('custodian_id', $custodianID)->first();
        $inventory = DB::table('t_inventory')->get();

        $notedid = "";
        $issuedid = "";
        $employeeid = "";
        $employee2id = "";

        if ($custodian) {
            $notedid = $custodian->noted;
            $issuedid = $custodian->issued;
            $employeeid = $custodian->name;
            $employee2id = $custodian->name2;
        } else {
            // Handle the case where no record is found
            $brandName = null; // Or any other default value or error handling
        }

        $noted = DB::table('m_employee')->where('employee_id', $notedid)->first();
        $issued = DB::table('m_employee')->where('employee_id', $issuedid)->first();
        $employee = DB::table('m_employee')->where('employee_id', $employeeid)->first();
        $employee2 = DB::table('m_employee')->where('employee_id', $employee2id)->first();

        $itemArray = json_decode($custodian->items);
        $items = [];
        foreach ($itemArray as $item) {
            // Check if 'items' key exists and 'item_id' key exists within it
            if (isset($item['items']['item_id'])) {
                $item_id = $item['items']['item_id'];

                // Append the item_id to the $items array
                $items[] = $item_id;
            }
        }


        $detail1 = DB::table('t_itemdetails')->get();
        $brand1 = DB::table('m_brand')->get();

        return view('form', [
            'details' => $detail1,
            'inventory' => $inventory,
            'items' => $itemArray,
            'brands' =>  $brand1,
            'custodian' => $custodian,
            'noted' => $noted,
            'issued' => $issued,
            'employee' => $employee,
            'employee2' => $employee2,
        ]);
    }
}
