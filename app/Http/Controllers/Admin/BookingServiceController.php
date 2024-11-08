<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\Booking;
use App\Models\BookingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class BookingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $deposits = BookingServices::with('booking', 'AdditionalService')->get();
            return DataTables::of($deposits)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-success editDeposit"><i class="ti-pencil"></i></a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger deleteDeposit"><i class="ti-trash"></i> DELETE</a>';
                    return $btn;
                })
                ->addColumn('booking.code_booking', function ($row) {
                    return $row->booking ? $row->booking->code_booking : 'N/A';
                })
                ->addColumn('AdditionalService.name', function ($row) {
                    return $row->AdditionalService ? $row->AdditionalService->name : 'N/A';
                })
            // ->addColumn('booking', function ($row) {
            //     return $row->booking ? $row->booking->code_booking : 'N/A';
            // })
                ->rawColumns(['action'])
                ->make(true);
        }

        $Booking = Booking::all();
        $AdditionalService = AdditionalService::all();

        // AdditionalService
        return view('admin.BookingServices', compact('Booking', 'AdditionalService'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'additional_service_id' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        BookingServices::updateOrCreate(
            ['id' => $request->id],
            $request->only([
                'booking_id',
                'additional_service_id',
                'price',
            ])
        );

        return response()->json(['success' => 'BookingServices saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'additional_service_id' => 'required',
            'price' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $BookingServices = BookingServices::findOrFail($id);
        $BookingServices->update($request->only([
            'booking_id',
            'additional_service_id',
            'price',
        ]));

        return response()->json(['success' => 'Booking updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BookingServices::where(['id' => $id])->first();
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BookingServices::where('id', $id)->delete();
        return response()->json(['success' => 'BookingServices deleted successfully.']);
    }
}
