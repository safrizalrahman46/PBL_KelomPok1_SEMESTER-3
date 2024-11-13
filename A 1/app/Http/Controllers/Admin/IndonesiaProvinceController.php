<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndonesiaProvince;
use Illuminate\Http\Request;

class IndonesiaProvinceController extends Controller
{
    public function index()
    {
        $provinces = IndonesiaProvince::all();
        return view('admin.provinces.index', compact('provinces'));
    }

    public function show($id)
    {
        $province = IndonesiaProvince::findOrFail($id);
        return view('admin.provinces.show', compact('province'));
    }

    // Add other CRUD methods (store, update, destroy)
}
