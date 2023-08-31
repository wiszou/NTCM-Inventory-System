<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        $name = $request->input('supplier-name');
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
        $rowCount = DB::table('m_category')->count();
        $rowCount++;
        $id = "Category" . getDate() . $rowCount++;
        return $id;
    }
    
    public function getDate(){
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        return $currentDate;
    }
}

?>