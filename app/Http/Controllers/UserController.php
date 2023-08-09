<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function UserRegistration(Request $request)
    {

        try {
            User::create([
                'firstName' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('phone'),
                'password' => $request->input('password')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Successful.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User Registration Failed.'
            ]);
        }
    }

    // User Login
    public function UserLogin(Request $request){
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->select('id')->first();

        if ($count !== null) {
            // User Login -> Issue JWT Token
            $token = JWTToken::CreateToken($request->input('email'), $count->id);

            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful.',
                'token' =>$token
            ])->cookie('token', $token, 60*60*24);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unautorized',
            ], 200);
        }
    }

    // Sent OTP code to mail & DB
    public function SendOTPCode(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(100000, 999999);
        $count = User::where('email', '=', $email)->count();

        if ($count == 1) {
            // OTP send to email
            Mail::to($email)->send(new OTPMail($otp));

            // OTP send to DB
            User::where('email', '=', $email)->update(['otp' => $otp]);

            return response()->json([
                'status' => 'success',
                'message' => '6 digits OTP Code has been sent to you.',
            ], 200);

        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unautorized',
            ], 200);
        }
    }

    // OTP Varification
    public function VarifyOTP(Request $request){
        $email = $request->input('email');
        $otp = $request->input('otp');

        $count = User::where('email', '=', $email)
        ->where('otp', '=', $otp)->count();

        if($count == 1){
            // Update OTP in DB
            User::where('email', '=', $email)->update(['otp' => '0']);

            // Reset Token Issuing for Pass token
            $token = JWTToken::CreateTokenForResetPassword($request->input('email'));

            return response()->json([
                'status' => 'success',
                'message' => 'OTP Varified Successfully.'

            ], 200)->cookie('token', $token, 60*60*24);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unautorized',
            ], 200);
        }
    }

    // Reset Password
    public function RestUserPass(Request $request){

        try{
            $email = $request->header('email');
            $password = $request->input('password');

            User::where('email', '=', $email)->update(['password'=>$password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Reset successful.'
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something went wrong.'
            ]);
        }
    }

}
