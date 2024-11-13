<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndonesiaVillage;
use Illuminate\Http\Request;

class IndonesiaVillageController extends Controller
{
    public function index()
    {
        $villages = IndonesiaVillage::all();
        return view('admin.villages.index', compact('villages'));
    }

    public function show($id)
    {
        $village = IndonesiaVillage::findOrFail($id);
        return view('admin.villages.show', compact('village'));
    }

    // Add other CRUD methods (store, update, destroy)
}
