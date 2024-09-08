<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {
    //

    public function userLoginPage() {
        return view('pages.login-page');
    }
    public function verifyPage() {
        return view('pages.verify-page');
    }
    public function userLogin(Request $request) {
        try {
            $userEmail = $request->userEmail;
            $otp = rand(1000, 9999);
            $details = ['code' => $otp];
            Mail::to($userEmail)->send(new OTPMail($details));

            User::updateOrCreate(['email' => $userEmail], ['email' => $userEmail, 'otp' => $otp]);

            return ResponseHelper::Out('success', '4 digit otp sent to your email', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 400);
        }
    }

    public function verifyOtp(Request $request) {
        try {
            $userEmail = $request->userEmail;
            $otp = $request->otp;

            // return [
            //     'otp' => $otp,
            //     'userEmail' => $userEmail,
            // ];
            $verify = User::where('email', $userEmail)->where('otp', $otp)->first();
            if ($verify) {
                User::where('email', $userEmail)->where('otp', $otp)->update(['otp' => 0]);
                $token = JWTToken::CreateToken($userEmail, $verify->id);
                return ResponseHelper::Out('success', 'user login successfully', 200)->cookie('token', $token, 60 * 60 * 24);
            } else {
                return ResponseHelper::Out('error', 'invalid otp', 401);
            }
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 400);
        }
    }

    public function logout() {
        try {
            return redirect("/userLoginPage")->cookie('token', '', -1);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 400);
        }
    }

}
