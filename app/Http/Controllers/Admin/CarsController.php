<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\DataTables;
use App\Models\cars;
use Illuminate\Http\Request; // Import PDF facade

use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class CarsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_Cars()
    //  {
    //      return \Excel::download(new CarsExport, 'Cars.xlsx');
    //  }
    //  public function export_tabel_Cars_pdf()
    //  {
    //     $Cars = Cars::all();
    //     $pdf = PDF::loadView('pdf.Cars', compact('Cars'));
    //     return $pdf->download('Cars.pdf');
    //  }

    public function index(Request $request)
    {
        $post = '';
        if ($request->ajax()) {
            $post = cars::get();
            return DataTables::of($post)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> </a>';

                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.car');
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
            'car' => 'required',
            'type' => 'required',
            'capacity' => 'required',
            'price_per_day' => 'required',
            'price_per_km' => 'required',
            'price_per_area' => 'required',
            'availability_start_time' => 'required',
            'availability_end_time' => 'required',
            'is_available' => 'required',
            'brand' => 'required',
            'transmission' => 'required',
            'buy_year' => 'required',
            'photo' => 'required',
            'seat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'car',
            'type',
            'capacity',
            'price_per_day',
            'price_per_km',
            'price_per_area',
            'availability_start_time',
            'availability_end_time',
            'is_available',
            'brand',
            'transmission',
            'buy_year',
            'photo',
            'seat',
        ]);

        // die(json_encode($post));
        // cars::updateOrCreate(
        //     $post,

        // );
        cars::updateOrCreate(
            ['id' => $request->id],
            $post
        );

        return response()->json(['success' => 'cars saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'car' => 'required',
            'type' => 'required',
            'capacity' => 'required',
            'price_per_day' => 'required',
            'price_per_km' => 'required',
            'price_per_area' => 'required',
            'availability_start_time' => 'required',
            'availability_end_time' => 'required',
            'is_available' => 'required',
            'brand' => 'required',
            'transmission' => 'required',
            'buy_year' => 'required',
            'photo' => 'required',
            'seat' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $cars = cars::findOrFail($id);
        $cars->update($request->only([
            'car',
            'type',
            'capacity',
            'price_per_day',
            'price_per_km',
            'price_per_area',
            'availability_start_time',
            'availability_end_time',
            'is_available',
            'brand',
            'transmission',
            'buy_year',
            'photo',
            'seat',
        ]));

        return response()->json(['success' => 'cars updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     $cars = cars::findOrFail($id);
        // return view('admin.cars_edit', compact('cars'));
        $post = cars::where(['id' => $id])->first();
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
        cars::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
