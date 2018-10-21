<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class VerifyPasswordController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
           'password_check' => 'required|min:6'
        ]);

        return response([
           'matches' => Hash::check($request->password_check, auth()->user()->password)
        ]);
    }
}
