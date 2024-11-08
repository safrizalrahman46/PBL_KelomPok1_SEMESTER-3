<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\DataTables;

use App\Models\DeliveryPickupCharge;
use Illuminate\Http\Request; // Import PDF facade

use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class DeliveryPickupChargesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_Charge()
    //  {
    //      return \Excel::download(new ChargeExport, 'Charge.xlsx');
    //  }
    //  public function export_tabel_Charge_pdf()
    //  {
    //     $Charge = Charge::all();
    //     $pdf = PDF::loadView('pdf.Charge', compact('Charge'));
    //     return $pdf->download('Charge.pdf');
    //  }

    public function index(Request $request)
    {
        // Get all available cars from the cars table
        // $availableCars = cars::where('is_available', 'yes')->get();

        if ($request->ajax()) {
            // $post = Charge::get();
            $post = DeliveryPickupCharge::get();
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

        return view('admin.delivery_pickup_charges');
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
            'pickup_location' => 'required',
            'dropoff_location' => 'required',
            'charge' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'pickup_location',
            'dropoff_location',
            'charge',
        ]);

        DeliveryPickupCharge::updateOrCreate(
            ['id' => $request->id],
            $post
        );

        return response()->json(['success' => 'Charge saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pickup_location' => 'required',
            'dropoff_location' => 'required',
            'charge' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $DeliveryPickupCharge = DeliveryPickupCharge::findOrFail($id);
        $DeliveryPickupCharge->update($request->only([
            'pickup_location',
            'dropoff_location',
            'charge',
        ]));

        return response()->json(['success' => 'Charge updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     $Charge = Charge::findOrFail($id);
        // return view('admin.Charge_edit', compact('Charge'));
        $post = DeliveryPickupCharge::where(['id' => $id])->first();
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
        DeliveryPickupCharge::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
