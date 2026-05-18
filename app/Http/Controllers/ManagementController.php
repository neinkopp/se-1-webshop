<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagementShowRequest;

class ManagementController extends Controller
{
    public function show(ManagementShowRequest $request) {
        return view('management-dashboard');
    }
}
