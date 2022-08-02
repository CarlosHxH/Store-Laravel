<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

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
        $product = Product::with(["category"])->paginate(9, array('*'), 'p');
        $category = Category::paginate(5, array('*'), 'c');
        return view('product.index',compact('product','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('all_files')) {
            $errors = [];
            foreach ($request->file('all_files') as $file) {
                if(!$file->isValid()) $errors[] = $file;
            }
            if(empty($errors)){
                try {
                    $prod = new Product();
                    $prod->name = $request->name;
                    $prod->price = $request->price;
                    $prod->stock = $request->stock;
                    $prod->file = $this->encode($request->file('all_files')[0]);
                    $prod->category_id = $request->category;
                    $prod->description = $request->description;
                    $prod->save();
                    return json_encode($prod);
                } catch (FileNotFoundException $e) {
                    return json_encode(['Error'=>'Imagem invalida!']);
                }
            }
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
    public function show(Product $product)
    {
        //$prod = Product::all();
        //return json_encode($prod);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return json_encode(Product::find($product->id));
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
        return json_encode(Category::find($id)->delete($id));
    }
}
