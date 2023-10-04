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

        $currentDate = date('D-M-Y');
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

        $item1 = ($item1 === 'none') ? null : $item1;
        $item2 = ($item2 === 'none') ? null : $item2;
        $item3 = ($item3 === 'none') ? null : $item3;
        $item4 = ($item4 === 'none') ? null : $item4;
        $item5 = ($item5 === 'none') ? null : $item5;
        $handlerName2 = ($handlerName2 === 'none') ? null : $handlerName2;

        if ($type == "none") {
            return response()->json(['success' => false, 'message' => 'Please select proper custodian type']);
        };

        if ($item1 == "none") {
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
            'type' => $type,
            'item1' => $item1,
            'item2' => $item2,
            'item3' => $item3,
            'item4' => $item4,
            'item5' => $item5,
            'user_created' => $user,
            'date_created' => $date,
        );




        try {
            DB::table('t_custodian')->insert($custodianData);
            $this->updateItem($item1, $item2, $item3, $item4, $item5, $type, $custodianID);
            $logController = new LogController();
            $logController->sendLog("Custodian Form " . $custodianID . " Succesfully added");
            $this->toPrint($custodianID);
            return response()->json(['success' => true, 'message' => 'Item added successfully.']);
        } catch (\Exception $e) {
            // Log or report the actual error message
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while adding the item.']);
        }
    }

    function updateItem($item1, $item2, $item3, $item4, $item5, $type, $id)
    {
        if ($type == "Deploy") {
            $type == "Deployed";
        };

        if ($type == "Borrow") {
            $type == "Borrowed";
        };

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        if ($item1 !== null) {
            $item1a = array(
                'item_status' => $type,
                'user_change' => $user,
                'date_change' => $date,
                'custodian_id' => $id
            );

            DB::table('t_inventory')->where('item_id', $item1)->update($item1a);
            $result = DB::table('t_inventory')->where('item_id', $item1)->first();
            if ($result) {
                $category_id = $result->category_id;
                $category = array(
                    'user_change' => $user,
                    'date_change' => $date,
                );
                DB::table('m_category')->where('category_id', $category_id)->update($category);
            } else {
            }
        }


        if ($item2 !== null) {
            $item2a = array(
                'item_status' => $type,
                'user_change' => $user,
                'date_change' => $date,
                'custodian_id' => $id
            );
            DB::table('t_inventory')->where('item_id', $item2)->update($item2a);
            $result = DB::table('t_inventory')->where('item_id', $item2)->first();
            if ($result) {
                $category_id = $result->category_id;
                $category = array(
                    'user_change' => $user,
                    'date_change' => $date,
                );
                DB::table('m_category')->where('category_id', $category_id)->update($category);
            } else {
            }
        }

        if ($item3 !== null) {
            $item3a = array(
                'item_status' => $type,
                'user_change' => $user,
                'date_change' => $date,
                'custodian_id' => $id
            );
            DB::table('t_inventory')->where('item_id', $item3)->update($item3a);
            $result = DB::table('t_inventory')->where('item_id', $item3)->first();
            if ($result) {
                $category_id = $result->category_id;
                $category = array(
                    'user_change' => $user,
                    'date_change' => $date,
                );
                DB::table('m_category')->where('category_id', $category_id)->update($category);
            } else {
            }
        }

        if ($item4 !== null) {
            $item4a = array(
                'item_status' => $type,
                'user_change' => $user,
                'date_change' => $date,
                'custodian_id' => $id
            );
            DB::table('t_inventory')->where('item_id', $item4)->update($item4a);
            $result = DB::table('t_inventory')->where('item_id', $item4)->first();
            if ($result) {
                $category_id = $result->category_id;
                $category = array(
                    'user_change' => $user,
                    'date_change' => $date,
                );
                DB::table('m_category')->where('category_id', $category_id)->update($category);
            } else {
            }
        }

        if ($item5 !== null) {
            $item5a = array(
                'item_status' => $type,
                'user_change' => $user,
                'date_change' => $date,
                'custodian_id' => $id
            );
            DB::table('t_inventory')->where('item_id', $item5)->update($item5a);
            $result = DB::table('t_inventory')->where('item_id', $item5)->first();
            if ($result) {
                $category_id = $result->category_id;
                $category = array(
                    'user_change' => $user,
                    'date_change' => $date,
                );
                DB::table('m_category')->where('category_id', $category_id)->update($category);
            } else {
            }
        }
    }

    public function toPrint($custodianID)
    {
        $custodian = DB::table('t_custodian')->where('custodian_id', $custodianID)->first();
        $inventory = DB::table('t_inventory')->get();


        $item1Value = $custodian->item1;
        $item2Value = $custodian->item2;
        $item3Value = $custodian->item3;
        $item4Value = $custodian->item4;
        $item5Value = $custodian->item5;


        $detail1 = DB::table('t_itemdetails')->where('item_id', $item1Value)->first();
        $detail2 = DB::table('t_itemdetails')->where('item_id', $item2Value)->first();
        $detail3 = DB::table('t_itemdetails')->where('item_id', $item3Value)->first();
        $detail4 = DB::table('t_itemdetails')->where('item_id', $item4Value)->first();
        $detail5 = DB::table('t_itemdetails')->where('item_id', $item5Value)->first();

        $item1 = DB::table('t_inventory')->where('item_id', $item1Value)->first();
        $item2 = DB::table('t_inventory')->where('item_id', $item2Value)->first();
        $item3 = DB::table('t_inventory')->where('item_id', $item3Value)->first();
        $item4 = DB::table('t_inventory')->where('item_id', $item4Value)->first();
        $item5 = DB::table('t_inventory')->where('item_id', $item5Value)->first();

        $brandid1 = $item1->brand_id;
        $brandid2 = $item2 ? $item2->brand_id : "";
        $brandid3 = $item3 ? $item3->brand_id : "";
        $brandid4 = $item4 ? $item4->brand_id : "";
        $brandid5 = $item5 ? $item5->brand_id : "";


        $brand1 = DB::table('m_brand')->where('brand_id', $brandid1)->first();
        $brand2 = DB::table('m_brand')->where('brand_id', $brandid2)->first();
        $brand3 = DB::table('m_brand')->where('brand_id', $brandid3)->first();
        $brand4 = DB::table('m_brand')->where('brand_id', $brandid4)->first();
        $brand5 = DB::table('m_brand')->where('brand_id', $brandid5)->first();

        return view('form', [
            'inventory' => $inventory,
            'inv1' => $item1,
            'inv2' => $item2,
            'inv3' => $item3,
            'inv4' => $item4,
            'inv5' => $item5,
            'detail1' => $detail1,
            'detail2' => $detail2,
            'detail3' => $detail3,
            'detail4' => $detail4,
            'detail5' => $detail5,
            'brand1' => $brand1,
            'brand2' => $brand2,
            'brand3' => $brand3,
            'brand4' => $brand4,
            'brand5' => $brand5,
            'custodian' => $custodian
        ]);
    }
}
