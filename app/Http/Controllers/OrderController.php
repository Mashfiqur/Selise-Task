<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderModel;
    protected $cartItemModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Order $orderModel,
                                CartItem $cartItemModel
    )
    {
        $this->orderModel = $orderModel;
        $this->cartItemModel = $cartItemModel;

    }


    /**
     * Display a listing of the resource.
     *
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request) {
     
        $user = User::where('id',auth()->user()->id)
                ->with(['orders', 'orders.packages', 'orders.packages.product'])->first();

        return view('orders.index', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\Response
     */
    public function store( Request $request) {
    
        $user = auth()->user();
        $cartItems = $this->cartItemModel->where('user_id', $user->id)->get();

        DB::beginTransaction();

        try{
            if($cartItems){
                $data = [];
                $orderId = Order::insertGetId([
                    'orderID' => time().-uniqid(true),
                    'user_id' => $user->id,
                    'status'  => 'Pending'
                ]);

                foreach($cartItems as $cartItem){
                    array_push($data, [
                        'order_id' => $orderId,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                        'price'   => $cartItem->price
                    ]);
                }
    
                Package::insert($data);
    
                CartItem::where('user_id', $user->id)->delete();
            }

            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

        return redirect()->route('orders.index');
    }
}
