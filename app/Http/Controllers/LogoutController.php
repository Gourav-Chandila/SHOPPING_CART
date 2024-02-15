<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout()
    {
        
        Session::flush(); // This will clear all session data

        return redirect('/login'); // Redirect to the login page after logout
    }
}
