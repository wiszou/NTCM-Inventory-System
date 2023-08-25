<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class LogRegController extends Controller
{
    public function registerUser(Request $request)
    {
        $dateTimeController = new DateTimeController();
        $username = $request->input('username');
        $password = $request->input('password');

        $hashedPassword = Hash::make($password);

        $uniqueId = Str::random(20);
        $duplicateCheck = DB::table('m-users')
            ->where('userID', $uniqueId)
            ->count();

        if ($duplicateCheck > 0) {
            $uniqueId = Str::random(20);
        } else {

            $currentDate = $dateTimeController->getDateTime(new Request());
            $userData = array(
                'username' => $username,
                'password' => $hashedPassword,
                'userID' => $uniqueId,
                'user-created' => "admin",
                'user-change' => 'admin',
                'date-created' => $currentDate,
                'date-change' => $currentDate
            );

            DB::table('m-users')->insert($userData);
            return response()->json(['message' => 'success'], 200);
        }
    }

    public function loginUser(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = DB::table('m-users')->where('username', $username)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                Session::put('user_id', $user->id);
                Session::put('user_name', $user->username);
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('welcome');
            }
        } else {
            return redirect()->route('welcome');
        }
    }
}
