<?php

namespace App\Http\Controllers;

class LoginController
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function show() {
        return view('management-login');
    }

    public function performLogin() {
        return response()->json([
            'status' => 'success',
            'message' => 'success'
        ], 201);
    }
}
