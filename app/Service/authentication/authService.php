<?php

namespace App\Service\authentication;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;

class authService
{
    // User Login Part Start ********************************
    public function userLogin($request): JsonResponse
    {
        try {
            $userEmail = $request->email;
            $OTP = rand(111111, 999999);
            $details = ['code' => $OTP];
            Mail::to($userEmail)->send(new OTPMail($details));
            User::updateOrCreate(['email' => $userEmail], ['email' => $userEmail, 'otp' => $OTP]);

            return ResponseHelper::Out(true, 'OTP Sent to your Email', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'User Login Failed', 500);
        }
    }
    // User Login Part End ********************************

    // Verify OTP Part Start ********************************
    public function verifyOTP($request): JsonResponse
    {
        try {
            $OTP = $request->otp;
            $userEmail = $request->email;
            $user = User::where('email', $userEmail)->where('otp', $OTP)->first();
            if ($user) {
                User::where('email', $userEmail)->where('otp', $OTP)->update(['otp' => '0']);
                $token = JWTToken::createToken($userEmail, $user->id, $user->role);

                return ResponseHelper::Out(true, 'OTP Verification Success', 200)->cookie('token', $token, 60 * 24);
            }

            return ResponseHelper::Out(false, 'unauthorized', 401);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'OTP Verification Failed', 500);
        }
    }
    // Verify OTP Part End ********************************

    // Logout Part Start ********************************
    public function logout($request)
    {
        try {
            $response = redirect()->route('HomePage');
            $response->withCookie(Cookie::forget('token')); // This will remove the cookie
            return $response;
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Logout Failed', 500);
        }
    }
}
