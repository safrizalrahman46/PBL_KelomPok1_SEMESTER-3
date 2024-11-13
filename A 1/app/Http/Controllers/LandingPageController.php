<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        // Implementasi method index
        return view('landingpage.landing'); // atau view yang sesuai
    }
}
