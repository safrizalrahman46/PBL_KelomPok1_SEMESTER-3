<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\DataTables;

use App\Models\IndonesiaCity;
use App\Models\IndonesiaDistrict;
use App\Models\IndonesiaProvince;
use App\Models\IndonesiaVillage;
use App\Models\Zone;
use Illuminate\Http\Request; // Import PDF facade

use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class ZonesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_Zone()
    //  {
    //      return \Excel::download(new ZoneExport, 'Zone.xlsx');
    //  }
    //  public function export_tabel_Zone_pdf()
    //  {
    //     $Zone = Zone::all();
    //     $pdf = PDF::loadView('pdf.Zone', compact('Zone'));
    //     return $pdf->download('Zone.pdf');
    //  }

    public function index(Request $request)
    {
        // Get all available cars from the cars table
        // $availableCars = cars::where('is_available', 'yes')->get();

        if ($request->ajax()) {
            // $post = Zone::get();
            // $post = Booking::with('car', 'user')->get();
            $post = Zone::with('name')->get();
            return DataTables::of($post)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Pass the available cars to the view
        $IndonesiaCity = IndonesiaCity::all();
        $IndonesiaDistrict = IndonesiaDistrict::all();
        $IndonesiaProvinces = IndonesiaProvince::all();
        $IndonesiaVillage = IndonesiaVillage::all();
        return view('admin.zones', compact('IndonesiaCity', 'IndonesiaDistrict', 'IndonesiaProvinces', 'IndonesiaVillage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zone_name' => 'required',
            'rate' => 'required',
            'province' => 'required',
            'regency_city' => 'required',
            'district' => 'required',
            'village' => 'required',
            'domicile_address' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'zone_name',
            'rate',
            'province',
            'regency_city',
            'district',
            'village',
            'domicile_address',

        ]);

        Zone::updateOrCreate(
            ['id' => $request->id],
            $post
        );

        return response()->json(['success' => 'Zone saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'zone_name' => 'required',
            'rate' => 'required',
            'province' => 'required',
            'regency_city' => 'required',
            'district' => 'required',
            'village' => 'required',
            'domicile_address' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $Zone = Zone::findOrFail($id);
        $Zone->update($request->only([
            'zone_name',
            'rate',
            'province',
            'regency_city',
            'district',
            'village',
            'domicile_address',

        ]));

        return response()->json(['success' => 'Zone updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     $Zone = Zone::findOrFail($id);
        // return view('admin.Zone_edit', compact('Zone'));
        $post = Zone::where(['id' => $id])->first();
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Zone::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
