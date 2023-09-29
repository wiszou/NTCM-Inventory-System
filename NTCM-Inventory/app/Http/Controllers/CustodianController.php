<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade


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
        return view('custodianCreate', ['inventory' => $inventory, 'categories' => $category, 'suppliers' => $supplier, 'details' => $itemdetails, 'custodian' => $custodian]);
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

        $currentDate = date('Y-m-d');
        $custodianID = $this->generateID();
        $handlerName = $request->input('handlerName');
        $handlerName2 = $request->input('handlerName2');
        $description = $request->input('description');
        $type = $request->input('type');
        $noted = $request->input('noted');
        $issued = $request->input('issued');
        $item1 = $request->input('item1');
        $item2 = $request->input('item2');
        $item3 = $request->input('item3');
        $item4 = $request->input('item4');
        $item5 = $request->input('item5');

        $item2 = ($item2 === 'none') ? null : $item2;
        $item3 = ($item3 === 'none') ? null : $item3;
        $item4 = ($item4 === 'none') ? null : $item4;
        $item5 = ($item5 === 'none') ? null : $item5;
        $handlerName2 = ($handlerName2 === 'none') ? null : $handlerName2;

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
            'type' => $type,
            'item1' => $item1,
            'item2' => $item2,
            'item3' => $item3,
            'item4' => $item4,
            'item5' => $item5,
            'user_created' => $user,
            'date_created' => $date,
        );

        DB::table('t_custodian')->insert($custodianData);
    }
}
