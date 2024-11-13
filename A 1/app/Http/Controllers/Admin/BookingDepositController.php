<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDeposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class BookingDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $deposits = BookingDeposit::with('booking')->get();
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
            // ->addColumn('booking', function ($row) {
            //     return $row->booking ? $row->booking->code_booking : 'N/A';
            // })
                ->rawColumns(['action'])
                ->make(true);
        }

        $Booking = Booking::all();

        return view('admin.BookingDeposits', compact('Booking'));
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
            'deposit_amount' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        BookingDeposit::updateOrCreate(
            ['id' => $request->id],
            $request->only(['booking_id', 'deposit_amount', 'status'])
        );

        return response()->json(['success' => 'BookingDeposit saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'deposit_amount' => 'required',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $BookingDeposit = BookingDeposit::findOrFail($id);
        $BookingDeposit->update($request->only([
            'booking_id', 'deposit_amount', 'status',
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
        $post = BookingDeposit::where(['id' => $id])->first();
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
        BookingDeposit::where('id', $id)->delete();
        return response()->json(['success' => 'BookingDeposit deleted successfully.']);
    }
}
