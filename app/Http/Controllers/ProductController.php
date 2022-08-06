<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class ProductController extends Controller
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
        $products = Product::with(["category"])->paginate(9, array('*'), 'p');
        $category = Category::paginate(5, array('*'), 'c');

        if (request()->ajax()) {
            return FacadesDataTables::of(Product::all())
                ->addIndexColumn()
                ->addColumn('file', function ($row) {
                    return "<img src='$row->file' width='100%'>";
                })->rawColumns(['file'])
                ->addColumn('action', function ($row) {
                    $action = "
                        <a href='/product/$row->id' class='btn btn-outline-success btn-sm mx-2 btn-edt'><i class='fa fa-pencil'></i></a>
                        <button data-id='$row->id' class='btn btn-outline-danger btn-sm btn-del'><i class='fa fa-trash'></i></button>
                    ";
                    return $action;
                })
                ->rawColumns(['file','action'])
                ->make(true);
        }
        return view('product.list',compact("products","category"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::with(["category"])->paginate(9, array('*'), 'p');
        $category = Category::paginate(5, array('*'), 'c');
        return view('product.create', compact('product','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'stock'=>'required',
            'file'=>'required|image|mimes:png,jpg,jpeg|max:10000'
         ]);

        if ($request->hasFile('file')) {
            $errors = [];
            foreach ($request->file('file') as $file) {
                if(!$file->isValid()) $errors[] = $file;
            }
            if(empty($errors)){
                try {
                    $prod = new Product();
                    $prod->name = $request->name;
                    $prod->price = $request->price;
                    $prod->stock = $request->stock;
                    $prod->file = $this->encode($request->file('file'));
                    $prod->category_id = $request->category;
                    $prod->description = $request->description;
                    if(!$prod->save()){
                        App::abort(500, 'Error');
                    }
                    return json_encode(['success'=>true]);
                } catch (FileNotFoundException $e) {
                    return json_encode(['Error'=>'Imagem invalida!']);
                }
            }
            return json_encode(["Error"=>$errors]);
        }
        return json_encode(["Error"=>"Erro ao carregar a imagem!"]);
    }


    public function encode($path){
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return json_encode($product);
        //return view('product.create',compact('product,category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return json_encode(Product::find($id)->delete($id));
    }
}
