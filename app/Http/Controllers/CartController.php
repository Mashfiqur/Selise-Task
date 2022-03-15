<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItem\StoreCartItemRequest;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartItemModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartItem $cartItemModel)
    {
        $this->cartItemModel = $cartItemModel;

        $this->middleware('id.dehashing')->only(['show','destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request) {
     
        $user = User::where('id',auth()->user()->id)
                ->with(['cart_items', 'cart_items.product'])->first();

        return view('carts.index', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\Response
     */
    public function store( StoreCartItemRequest $request) {
    
        if($request->validated()){

            $data = $request->validated();

            if($this->cartItemModel->where([['product_id',$data['product_id']], ['price', $data['price']]])->exists()){

                $this->cartItemModel->where([['product_id',$data['product_id']], ['price', $data['price']]])->increment('quantity',$data['quantity']);
            }

            else{
                $this->cartItemModel->create($data);
            }

            return back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\Response
     */
    public function destroy( $cartItem) {
    
        if($cartItem){
            $this->cartItemModel->where('id', $cartItem)->delete();
        }
        return back();

    }
}
