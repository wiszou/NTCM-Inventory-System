<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class LogRegController extends Controller
{   
    public function registerUser(Request $request)
    {
        $dateTimeController = new DateTimeController();
        $username = $request->input('username');
        $password = $request->input('password');
 
        $hashedPassword = Hash::make($password);
        $limitedHashedPassword = substr($hashedPassword, 0, 50);

        $uniqueId = Str::random(20);
        $duplicateCheck = DB::table('m-users')
            ->where('userID', $uniqueId)
            ->count();

            if ($duplicateCheck > 0) {
                $uniqueId = Str::random(20);
            } else {
                
                $currentDate = $dateTimeController->getDateTime(new Request());
                echo $currentDate;
                // $userData = array(
                //     'username' => $username,
                //     'password' => $limitedHashedPassword,
                //     'userID' => $uniqueId,
                //     'user-created' => "admin",
                //     'user-change' => 'admin'
                //     'date-created' => $currentDate,
                //     'date-change' => $currentDate
                // );
    
                // DB::table('m-users')->insert($userData);
                // return response()->json(['message' => 'success'], 200);
        }
    }

}