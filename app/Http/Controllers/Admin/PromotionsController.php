<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\DataTables;

use App\Models\Promotion;
use Illuminate\Http\Request; // Import PDF facade

use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class PromotionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        if ($request->ajax()) {
            // $post = Promotion::get();
            $post = Promotion::get();
            return DataTables::of($post)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> </a>';
                    return $btn;
                })

                ->addColumn('image', function ($row) {

                    $btn = '';

                    if (!empty($row->banner_url)) {

                        $btn = '<a href="' . asset('public/uploads/' . $row->banner_url) . '" data-lightbox="roadtrip" class="img-link">';
                        $btn .= '<img src="' . asset('public/uploads/' . $row->banner_url) . '" data-lightbox="roadtrip" class="rounded float-left img-thumbnail" style="width:60px;"    alt="' . $row->gambar . '" />';
                        $btn .= '</a>';
                    }

                    return $btn;
                })

                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('admin.promotions');
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
            // 'banner_url' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'description' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Move the image to the public directory
            $image->move(public_path('uploads'), $imageName);

            $post['banner_url'] = $imageName;

        }

        Promotion::updateOrCreate(
            ['id' => $request->id],
            $post
        );

        return response()->json(['success' => 'Promotion saved successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Promotion::where(['id' => $id])->first();
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
        Promotion::where(['id' => $id])->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }

}