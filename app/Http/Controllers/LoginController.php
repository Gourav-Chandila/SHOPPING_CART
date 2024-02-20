<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function registerLogin(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'phonenumber' => 'required|numeric|digits:10',
        ]);

        $phonenumber = $request->input('phonenumber');
        $password = trim($request->input('password'));

        Log::info('Attempting login with phone number: ' . $phonenumber);

        $userLogin = UserLogin::select(
            'ul.USER_LOGIN_ID',
            'ul.PARTY_ID',
            'tn.CONTACT_NUMBER',
            'p.FIRST_NAME',
            'p.LAST_NAME',
            'ul.CURRENT_PASSWORD', // Fetch the CURRENT_PASSWORD field
            'pa.ADDRESS1',
            'pa.ADDRESS2',
            'pcp.CONTACT_MECH_PURPOSE_TYPE_ID'
        )
            ->from('user_login as ul')
            ->join('telecom_number as tn', 'ul.USER_LOGIN_ID', '=', 'tn.CONTACT_NUMBER')
            ->join('person as p', 'p.PARTY_ID', '=', 'ul.PARTY_ID')
            ->join('party_contact_mech as pcm', 'pcm.PARTY_ID', '=', 'ul.PARTY_ID')
            ->join('postal_address as pa', 'pa.CONTACT_MECH_ID', '=', 'pcm.CONTACT_MECH_ID')
            ->join('party_contact_mech_purpose as pcp', 'pa.CONTACT_MECH_ID', '=', 'pa.CONTACT_MECH_ID')
            ->where('tn.CONTACT_NUMBER', $phonenumber) // Use the correct column name
            ->first();
            // The first() method retrieves the first record that matches the query criteria  
        // Now you can access the data like this:
        if ($userLogin && Hash::check($password, $userLogin->CURRENT_PASSWORD)) {
            // Redirect to welcome page
            Session::put('PARTY_ID', $userLogin->PARTY_ID);
            Session::put('FIRST_NAME', $userLogin->FIRST_NAME);
            Session::put('LAST_NAME', $userLogin->LAST_NAME);
            Session::put('ADDRESS1', $userLogin->ADDRESS1);
            Session::put('ADDRESS2', $userLogin->ADDRESS2);
            
            // check in db shows where phno  1433214585  CONTACT_MECH_PURPOSE_TYPE_ID='GENERAL_LOCATION' but in navbar show PRIMARY_PHONE
            Session::put('CONTACT_MECH_PURPOSE_TYPE_ID', $userLogin->CONTACT_MECH_PURPOSE_TYPE_ID);
            
            //redirect to welocome page if login was successfull
            return redirect('/');
        } else {
            Log::warning('Login failed for phone number: ' . $phonenumber);
            // User credentials are invalid, redirect back with an error message
            return redirect()->back()->withInput($request->only('phonenumber'))
                ->with('error', 'Invalid phone number or password');
        }
    }
}
