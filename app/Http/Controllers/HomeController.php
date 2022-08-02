<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::with(["category"])->paginate(9, array('*'), 'p');
        $category = Category::paginate(5, array('*'), 'c');
        return view('product.index',compact('product','category'));
    }

    public function category($id){
        $product = Category::with(['product'])->where('id', '=', $id)->paginate(9, array('*'), 'p');
        $category = Category::paginate(5, array('*'), 'c');
        return view('product.index',compact('product','category'));
    }
}
