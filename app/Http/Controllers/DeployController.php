<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeployController extends Controller
{
    public function deploy(Request $request) 
    {
        Artisan::call('git:deploy');

        //return 
        exit;
    }
}
