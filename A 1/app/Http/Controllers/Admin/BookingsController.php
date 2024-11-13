<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\DataTables;
use App\Models\Booking;
use App\Models\cars;
use App\Models\User;
use Illuminate\Http\Request; // Import PDF facade

use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class BookingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_Booking()
    //  {
    //      return \Excel::download(new BookingExport, 'Booking.xlsx');
    //  }
    //  public function export_tabel_Booking_pdf()
    //  {
    //     $Booking = Booking::all();
    //     $pdf = PDF::loadView('pdf.Booking', compact('Booking'));
    //     return $pdf->download('Booking.pdf');
    //  }

    // public function index(Request $request)
    // {
    //     $post = '';
    //     if ($request->ajax()) {
    //         $post = Booking::get();
    //         return DataTables::of($post)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($row) {
    //                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i></a>';

    //                 $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> </a>';

    //                 return $btn;
    //             })
    //             // ->addColumn('status', function ($row) {
    //             //     return $row->status == 1 ? '<span class="badge badge-success">available</span>' : '<span class="badge badge-danger">Available</span>';
    //             // })
    //             ->rawColumns(['action','status'])
    //             ->make(true);
    //     }

    //     return view('admin.car_availability');
    // }

    public function index(Request $request)
    {
        // Get all available cars from the cars table
        // $availableCars = cars::where('is_available', 'yes')->get();

        if ($request->ajax()) {
            // $post = Booking::get();
            $post = Booking::with('car', 'user')->get();
            return DataTables::of($post)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> </a>';
                    return $btn;
                })

                ->addColumn('User.name', function ($row) {
                    return $row->user ? $row->user->name : 'N/A';
                })
                ->addColumn('car.car', function ($row) {
                    return $row->car ? $row->car->car : 'N/A';
                })
            // ->addColumn('status', function ($row) {
            //     return $row->status == 1 ? '<span class="badge badge-success">Completed</span>' : '<span class="badge badge-warning">Booked</span>' ; '<span class="badge badge-danger">Booked</span>';
            // })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        // Pass the available cars to the view
        $User = User::all();
        $cars = cars::all();
        return view('admin.bookings', compact('cars', 'User'));
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
            'user_id' => 'required',
            'car_id' => 'required',
            'pickup_location' => 'required',
            'dropoff_location' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'status' => 'required',
            'code_booking' => 'required',
            'booking_group_id' => 'required',
            'booking_duration' => 'required',
            'total_price' => 'required',
            'total_deposit' => 'required',
            'total_payment' => 'required',
            'total_additional_price' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'user_id',
            'car_id',
            'pickup_location',
            'dropoff_location',
            'start_datetime',
            'end_datetime',
            'status',
            'code_booking',
            'booking_group_id',
            'booking_duration',
            'total_price',
            'total_deposit',
            'total_payment',
            'total_additional_price',

        ]);

        Booking::updateOrCreate(
            ['id' => $request->id],
            $post
        );

        return response()->json(['success' => 'Booking saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'car_id' => 'required',
            'pickup_location' => 'required',
            'dropoff_location' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'status' => 'required',
            'code_booking' => 'required',
            'booking_group_id' => 'required',
            'booking_duration' => 'required',
            'total_price' => 'required',
            'total_deposit' => 'required',
            'total_payment' => 'required',
            'total_additional_price' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $Booking = Booking::findOrFail($id);
        $Booking->update($request->only([
            'user_id',
            'car_id',
            'pickup_location',
            'dropoff_location',
            'start_datetime',
            'end_datetime',
            'status',
            'code_booking',
            'booking_group_id',
            'booking_duration',
            'total_price',
            'total_deposit',
            'total_payment',
            'total_additional_price',

        ]));

        return response()->json(['success' => 'Booking updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     $Booking = Booking::findOrFail($id);
        // return view('admin.Booking_edit', compact('Booking'));
        $post = Booking::where(['id' => $id])->first();
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
        Booking::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
