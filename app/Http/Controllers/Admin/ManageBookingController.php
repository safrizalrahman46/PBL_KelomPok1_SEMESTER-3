<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\DataTables;
use App\Models\Booking;
// use App\Models\User;

use App\Models\ManageBooking;
use Illuminate\Http\Request; // Import PDF facade

use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class ManageBookingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_ManageBooking()
    //  {
    //      return \Excel::download(new ManageBookingExport, 'ManageBooking.xlsx');
    //  }
    //  public function export_tabel_ManageBooking_pdf()
    //  {
    //     $ManageBooking = ManageBooking::all();
    //     $pdf = PDF::loadView('pdf.ManageBooking', compact('ManageBooking'));
    //     return $pdf->download('ManageBooking.pdf');
    //  }

    public function index(Request $request)
    {
        // Get all available cars from the cars table
        // $availableCars = cars::where('is_available', 'yes')->get();

        if ($request->ajax()) {
            // $post = ManageBooking::get();
            $post = ManageBooking::with('booking')->get();
            return DataTables::of($post)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> </a>';
                    return $btn;
                })

                ->addColumn('booking.code_booking', function ($row) {
                    return $row->booking ? $row->booking->code_booking : 'N/A';
                })
            // ->addColumn('booking.status', function ($row) {
            //     return $row->booking ? $row->booking->status : 'N/A';
            // })
            // ->addColumn('status', function ($row) {
            //     return $row->status == 1 ? '<span class="badge badge-success">Completed</span>' : '<span class="badge badge-warning">Booked</span>' ; '<span class="badge badge-danger">Booked</span>';
            // })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Pass the available cars to the view
        // $User = User::all();
        $Booking = Booking::all();
        return view('admin.ManageBooking', compact('Booking'));
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
            'booking_id' => 'required',
            'status' => 'required',
            'notes' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'booking_id',
            'status',
            'notes',
        ]);
        // die(json_encode($post));

        ManageBooking::updateOrCreate(
            ['id' => $request->id],
            $post
        );

        return response()->json(['success' => 'ManageBooking saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'status' => 'required',
            'notes' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $ManageBooking = ManageBooking::findOrFail($id);
        $ManageBooking->update($request->only([
            'booking_id',
            'status',
            'notes',
        ]));

        return response()->json(['success' => 'ManageBooking updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     $ManageBooking = ManageBooking::findOrFail($id);
        // return view('admin.ManageBooking_edit', compact('ManageBooking'));
        $post = ManageBooking::where(['id' => $id])->first();
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
        ManageBooking::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
