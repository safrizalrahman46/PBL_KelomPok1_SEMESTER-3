<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\DataTables;

use App\Models\AdditionalService;
use Illuminate\Http\Request; // Import PDF facade

use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class AdditionalServicesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $post = Charge::get();
            $post = AdditionalService::get();
            return DataTables::of($post)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> </a>';
                    return $btn;
                })
                ->addColumn('price', function ($row) {
                    return 'Rp. ' . number_format($row->price);

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Pass the available cars to the view

        return view('admin.additional_services');
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
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'name',
            'price',
        ]);

        AdditionalService::updateOrCreate(
            ['id' => $request->id],
            $post
        );

        return response()->json(['success' => 'Charge saved successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = AdditionalService::where(['id' => $id])->first();
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
        AdditionalService::where(['id' => $id])->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }

}