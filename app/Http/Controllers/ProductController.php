<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;

        $this->middleware('id.dehashing')->only(['show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
        $products = $this->productModel->paginate(10);
        
        return view('products.index', compact('products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\Response
     */
    public function show($productId) {
    
        $product = $this->productModel->findOrFail($productId);
        
        return view('products.show', compact('product'));
    }
}
