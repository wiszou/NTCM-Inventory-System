<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        $name = $request->input('supplier-name');
        $prefix = $request->input('prefix');
        $id =  $this->generateID();
        $user = session()->get('user_name');

                $supplierData = array(
                    'category_id' => $id,
                    'category_name' => $name,
                    'user_created' => $user,
                    'user_change' => $user,
                    'date_created' => getDate(),
                    'date_change' => getDate()
                );
        
        DB::table('m_inventory')->insert($supplierData);
    }

    public function generateID(){
        
        $currentYear = date('Y');
        $rowCount = DB::table('m_category')->count();
    
        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "ID-Category-" . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('category_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Category-" . $formattedRowCount;
            $existingCategory = DB::table('m_category')->where('category_id', $candidateId)->first();
        }
    
        return $candidateId;
    }
    
    
    public function getDate(){
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        return $currentDate;
    }
}
