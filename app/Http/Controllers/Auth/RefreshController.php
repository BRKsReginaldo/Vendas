<?php

namespace App\Http\Controllers\Auth;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RefreshController extends Controller
{
    public function refresh(Request $request)
    {
        $request->validate([
           'refreshToken' => 'required|string'
        ]);

        $response = refreshToken($request->refreshToken);

        return $response;
    }
}
