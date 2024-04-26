<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\payment;
use Illuminate\Support\Facades\Validator;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Contracts\Mail\Mailable;



class Apicontroller extends Controller
{
    public function register(Request $req)
    {
        // Define validation rules
        $rules = [
            'username' => 'required',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
            'phone' => 'required|numeric',
        ];

        // Validate the incoming request
        $validator = Validator::make($req->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 400);
        }

        // If validation passes, proceed with saving the user
        $user = new users();
        $user->username = $req->username;
        $user->email = $req->email;
        $user->password = $req->password;
        $user->phone = $req->phone;
        $result = $user->save();

        if ($result) {
            return ["Result" => "Data Inserted"];
        } else {
            return ["Result" => "Data Not Inserted"];
        }
    }

    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }

        // Attempt to authenticate the user
        $user = users::where('email', $request->email)->first();
        if ($user) {
            if ($user->password == $request->password) {
                // Authentication successful
                return response()->json([
                    'code' => 200,
                    'status' => 1,
                    'message' => 'Login successful',
                ]);
            } else {
                // Invalid password
                return response()->json([
                    'code' => 401,
                    'status' => 0,
                    'message' => 'Invalid password',
                ]);
            }
        } else {
            // User not found
            return response()->json([
                'code' => 404,
                'status' => 0,
                'message' => 'User not found',
            ]);
        }
    }

    public function payment(Request $req)
    {
        // Validate the request data
        $validator = Validator::make($req->all(), [
            'mobile_no' => 'required|numeric',
            'payment_id' => 'required',
            'status' => 'required',
            'date' => 'required',
            'plan_type' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }

        // Payment logic
        $payment = new Payment();
        $payment->mobile_no = $req->mobile_no;
        $payment->payment_id = $req->payment_id;
        $payment->status = $req->status;
        $payment->date = $req->date;
        $payment->plan_type = $req->plan_type;
        $result = $payment->save();

        if ($result) {
            return response()->json(['code' => 200, 'status' => 1, 'Result' => 'Data Inserted']);
        } else {
            return response()->json(['Result' => 'Data Not Inserted'], 500);
        }
    }

    public function changePassword(Request $req)
    {
        // Validate the request data
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }

        // Retrieve the payment record by email
        $user = users::where('email', $req->email)->first();

        // Check if the payment record exists
        if (!$user) {
            return response()->json([
                'code' => 404,
                'status' => 0,
                'message' => 'user record not found',
            ]);
        }

        // Update password and confirm_password fields
        $user->password = $req->password;
        $c_pass = $req->confirm_password;

        // Save the changes if passwords match
        if ($user->password == $c_pass) {
            $result = $user->save();
            if ($result) {
                return response()->json(['code' => 200, 'status' => 1, 'message' => 'Password changed successfully']);
            } else {
                return response()->json(['code' => 500, 'status' => 0, 'message' => 'Failed to change password']);
            }
        } else {
            return response()->json(['code' => 400, 'status' => 0, 'message' => 'Passwords do not match']);
        }
    }
    // public function for_pwd(Request $request)
    // {
    //     // $user = users::where('email', $request->email)->first();
    //     // if (!$user) {
    //     //     return response()->json(['error' => 'User not found'], 404);
    //     // } else {
    //     //     return response()->json(['error' => 'User found'], 200);
    //     // }

    //     $otp = mt_rand(100000, 999999); // Generate OTP
    //     // cache(['otp_' . $user->id => $otp], now()->addMinutes(10)); // Store OTP in cache
    //     // $data = array(
    //     //     'text' => 'email'
    //     // );

    //     // $data = array('name' => "Virat Gandhi");

    //     Mail::send([], [], function ($message) {
    //         $message->to('maniyanidhi11@gmail.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail')->setBody('Dear Pratapbhai Savajibhai Rebdiya,

    //         Your (Aadhaar number XXXX8836) one time PIN is: 485026, and is valid for 10 minutes.

    //         (Generated at 2024-03-27 08:07:38)


    //         ********************************
    //         This is an auto-generated email.  Do not reply to this email.');
    //         $message->from('brainartitsolution@gmail.com', 'Virat Gandhi');
    //     });
    //     echo "Basic Email Sent. Check your inbox.";

    //     return response()->json(['message' => 'OTP sent to your email']);
    // }

    public function for_pwd(Request $request)
    {
        // Generate OTP
        $otp = mt_rand(100000, 999999);

        // Dynamic user email address and name
        $userEmail = $request->input('email');
        Cache::put('otp_' . $userEmail, $otp, now()->addMinutes(10));
        Mail::send([], [], function ($message) use ($userEmail, $otp) {
            $message->to($userEmail)->subject('Your One-Time Passcode (OTP) for forget password')
                ->setBody("Hello,\n\n<br><br><span style='color:blue; font-weight:800'>{$otp}</span> is your one-time passcode (OTP) for the AI NexGenius app.\n\n<br><br>You can tap on the code to have it automatically applied. If this doesn’t work, please either Copy and Paste or enter the code manually when prompted in the App.\n\n<br><br>The code was requested from the AI NexGenius App. It will be valid for 4 hours.\n\n<br><br>Enjoy the app!", 'text/html');
            $message->from('brainartitsolution@gmail.com', ' AI NexGenius ');
        });

        return response()->json(['code' => 200, 'status' => 1, 'message' => 'OTP sent to your email']);
    }
    public function verifyOtp(Request $request)
    {
        $userEmail = $request->input('email');
        $enteredOtp = $request->input('otp');

        // Retrieve the OTP from the cache based on the user's email
        $cachedOtp = Cache::get('otp_' . $userEmail);

        if (!$cachedOtp || $cachedOtp != $enteredOtp) {
            return response()->json(['code' => 400, 'status' => 0, 'message' => 'Invalid OTP'], 400);
        }

        // If OTP is valid, you can perform further actions such as resetting the password
        // For example, you can return a success message here

        return response()->json(['code' => 200, 'status' => 1, 'message' => 'OTP verified successfully']);
    }

    public function resetPassword(Request $request)
    {
        // Here you can implement the logic to reset the user's password
        // For example, you can retrieve the user based on email and update the password

        $userEmail = $request->input('email');
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        // Check if new password matches the confirmation password
        if ($newPassword !== $confirmPassword) {
            return response()->json(['code' => 400, 'status' => 0, 'message' => 'Password confirmation does not match'], 400);
        }

        $user = users::where('email', $userEmail)->first();

        if (!$user) {
            return response()->json(['code' => 400, 'status' => 0, 'message' => 'User not found'], 404);
        }

        // Update user's password
        $user->password = $newPassword;
        $user->save();

        return response()->json(['code' => 200, 'status' => 1, 'message' => 'Password reset successfully']);
    }
    public function updateProfile(Request $request)
    {
        // Validation rules
        $rules = [
            'id' => 'required|exists:user,id',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $request->input('id'),
            'phone' => 'required|string|max:20',
        ];

        // Custom error messages
        $messages = [
            'email.unique' => 'The email has already been taken.',
        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);

            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Validation failed: ' . $errorMessage,
            ], 400);
        }

        $userID = $request->input('id');
        $userName = $request->input('username');
        $userEmail = $request->input('email');
        $userPhone = $request->input('phone');

        $user = users::findOrFail($userID);

        // Update user's profile
        $user->email = $userEmail;
        $user->username = $userName;
        $user->phone = $userPhone;
        $user->save();
        $user->refresh();

        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }
}
