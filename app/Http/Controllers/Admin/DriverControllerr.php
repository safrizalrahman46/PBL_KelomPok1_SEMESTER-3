<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\DataTables;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import PDF facade

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class DriverControllerr extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_Driver()
    //  {
    //      return \Excel::download(new DriverExport, 'Driver.xlsx');
    //  }
    //  public function export_tabel_Driver_pdf()
    //  {
    //     $Driver = Driver::all();
    //     $pdf = PDF::loadView('pdf.Driver', compact('Driver'));
    //     return $pdf->download('Driver.pdf');
    //  }

    public function index(Request $request)
    {
        // Get all available cars from the cars table
        // $availableCars = cars::where('is_available', 'yes')->get();

        if ($request->ajax()) {
            // $post = Driver::get();
            $post = Driver::get();
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

        return view('admin.Driver');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // \Log::info($request->all()); // Log all request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'driving_license' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'expired_driving_license' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        // Store the photo
        if ($request->hasFile('photo')) {
            $path_photo = $request->file('photo')->store('public/photos');
        }

        // Store the driving license image
        if ($request->hasFile('driving_license')) {
            $path_driving_license = $request->file('driving_license')->store('public/driving_licenses');
        }

        // Collect data and save
        $data = array_merge($request->only([
            'name', 'expired_driving_license', 'gender', 'address',
        ]), [
            'photo' => $path_photo ?? null,
            'driving_license' => $path_driving_license ?? null,
        ]);

        $post = $request->only([
            'name',
            'photo',
            'driving_license',
            'expired_driving_license',
            'gender',
            'address',
        ]);

        Driver::updateOrCreate(
            ['id' => $request->id],
            $post
        );

        return response()->json(['success' => 'Driver saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'driving_license' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'expired_driving_license' => 'required',
            'gender' => 'required',
            'address' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $Driver = Driver::findOrFail($id);

        // Update the photo
        if ($request->hasFile('photo')) {
            $path_photo = $request->file('photo')->store('public/photos');
            $Driver->photo = $path_photo;
        }

        // Update the driving license image
        if ($request->hasFile('driving_license')) {
            $path_driving_license = $request->file('driving_license')->store('public/driving_licenses');
            $Driver->driving_license = $path_driving_license;
        }

        $Driver = Driver::findOrFail($id);
        $Driver->update($request->only([
            'name',
            'photo',
            'driving_license',
            'expired_driving_license',
            'gender',
            'address',
        ]));

        return response()->json(['success' => 'Driver updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     $Driver = Driver::findOrFail($id);
        // return view('admin.Driver_edit', compact('Driver'));
        $post = Driver::where(['id' => $id])->first();
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
        Driver::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
