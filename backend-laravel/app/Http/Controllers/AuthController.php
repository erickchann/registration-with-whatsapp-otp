<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'number' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid Field'], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'number' => $request->number,
            'password' => bcrypt($request->password),
            'active' => 'N'
        ]);

        $otp = Otp::create([
            'user_id' => $user->id,
            'otp' => $this->getOtp()
        ]);

        $number = $user->number;
        $message = "OTP ANDA ADALAH: *$otp->otp*";
        $id = Device::all()[0]->id;

        $response = Http::post(env('URL_WA_SERVER') . '/chat/send?id=' . $id, [
            'receiver' => $number,
            'message' => $message
        ]);

        $res = json_decode($response->getBody());

        return $res;
    }

    public function getOtp() 
    {
        $otp = $this->randomNumber(4);

        while (Otp::where('otp', $otp)->first()) {
            $otp = $this->randomNumber(4);
        }

        return $otp;
    }

    public function randomNumber($length) 
    {
        $result = '';
    
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
    
        return $result;
    }
}
