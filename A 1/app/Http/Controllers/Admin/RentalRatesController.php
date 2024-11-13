<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\DataTables;
use App\Models\cars;
use App\Models\RentalRates;
use Illuminate\Http\Request; // Import PDF facade

use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class RentalRatesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_RentalRates()
    //  {
    //      return \Excel::download(new RentalRatesExport, 'RentalRates.xlsx');
    //  }
    //  public function export_tabel_RentalRates_pdf()
    //  {
    //     $RentalRates = RentalRates::all();
    //     $pdf = PDF::loadView('pdf.RentalRates', compact('RentalRates'));
    //     return $pdf->download('RentalRates.pdf');
    //  }

    public function index(Request $request)
    {
        $post = '';
        if ($request->ajax()) {
            $post = RentalRates::with('car')->get();
            return DataTables::of($post)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> </a>';

                    return $btn;
                })
            // ->addColumn('status', function ($row) {
            //     return $row->status == 1 ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            // })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $cars = cars::all();
        return view('admin.RentalRates', compact('cars'));
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
            'car_id' => 'required',
            'date' => 'required',
            'daily_rate' => 'required',
            'season' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'car_id',
            'date',
            'daily_rate',
            'season',
        ]);

        RentalRates::updateOrCreate(
            ['id' => $request->id],
            $post
        );

        return response()->json(['success' => 'RentalRates saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required',
            'date' => 'required',
            'daily_rate' => 'required',
            'season' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $RentalRates = RentalRates::findOrFail($id);
        $RentalRates->update($request->only([
            'car_id',
            'date',
            'daily_rate',
            'season',

        ]));

        return response()->json(['success' => 'RentalRates updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     $RentalRates = RentalRates::findOrFail($id);
        // return view('admin.RentalRates_edit', compact('RentalRates'));
        $post = RentalRates::where(['id' => $id])->first();
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
        RentalRates::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
