<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndonesiaDistrict;
use Illuminate\Http\Request;

class IndonesiaDistrictController extends Controller
{
    public function index()
    {
        $districts = IndonesiaDistrict::all();
        return view('admin.districts.index', compact('districts'));
    }

    public function show($id)
    {
        $district = IndonesiaDistrict::findOrFail($id);
        return view('admin.districts.show', compact('district'));
    }

    // Add other CRUD methods (store, update, destroy)
}

