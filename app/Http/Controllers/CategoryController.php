<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class CategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return FacadesDataTables::of(Category::all())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "
                        <button data-id='$row->id' class='btn btn-outline-success btn-sm mx-2 btn-edt'><i class='fa fa-pencil'></i></button>
                        <button data-id='$row->id' class='btn btn-outline-danger btn-sm btn-del'><i class='fa fa-trash'></i></button>
                    ";
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('category.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required',
        ]);

        if ($cat = Category::where('name', $request->category)->update(['name' => $request->category])) {
            return json_encode($cat);
        } else if ($cat = Category::where('id', $request->id)->update(['name' => $request->category])) {
            return json_encode($cat);
        } else {
            $cat = Category::create(['name' => $request->category]);
            return json_encode($cat);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return Category::all()->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return json_encode(Category::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return json_encode(Category::find($id)->delete($id));
    }
}
