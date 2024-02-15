<?php
// RegisterationController.php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLogin; // Import the PostalAddress  model 


class ForgetPasswordController extends Controller
{

    public function index()
    {
        return view('forget_password');
    }


    public function resetPassword(Request $request)
    {
        //validation of Registeration form
        $request->validate([
            'phonenumber' => 'required|numeric|digits:10',
            'password' => 'required',
        ]);


        // Retrieve the phone number and password from the request
        $phoneNumber = $request->input('phonenumber');
        $newPassword = trim($request->input('password'));

        // Check if the user with the provided phone number exists
        $user = UserLogin::where('USER_LOGIN_ID', $phoneNumber)->first();

        if ($user) {
            // If the user exists, update the CURRENT_PASSWORD field with the new password
            $user->update([
                'CURRENT_PASSWORD' => Hash::make($newPassword) // Hash the new password
            ]);

            // Password updated successfully, you can redirect or return a success message
            return redirect()->back()->with('success', 'Password updated successfully.');
        } else {
            // User does not exist with the provided phone number
            return redirect()->back()->with('error', 'User with the provided phone number does not exist.');
        }
    }



}













