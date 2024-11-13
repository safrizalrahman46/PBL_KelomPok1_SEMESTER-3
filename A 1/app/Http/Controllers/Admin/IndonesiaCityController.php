<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndonesiaCity;
use Illuminate\Http\Request;

class IndonesiaCityController extends Controller
{
    public function index()
    {
        $cities = IndonesiaCity::all();
        return view('admin.cities.index', compact('cities'));
    }

    public function show($id)
    {
        $city = IndonesiaCity::findOrFail($id);
        return view('admin.cities.show', compact('city'));
    }

    // Add other CRUD methods (store, update, destroy)
}
