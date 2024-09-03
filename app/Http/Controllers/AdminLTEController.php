<?php


// app/Http/Controllers/AdminLTEController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLTEController extends Controller
{
    public function showMaster()
    {
        return view('vendor.adminlte.master');
    }

    
    public function showPage()
    {
        return view('vendor.adminlte.page');
    }
        
}
