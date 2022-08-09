<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('client.checkout', [
            'totalAll' => $request->totalAll,
            'user_id' => $request->user_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'order'");
        $nextId = $statement[0]->Auto_increment;
        $carts = Cart::select('cart.*', 'products.name', 'products.image', 'products.price')->join('products', 'cart.product_id', '=', 'products.id')->where('user_id', '=', Auth::user()->id)->get();
        $order = new Order();
        $order->date = date('Y-m-d');
        $order->coupon = $request->coupon;
        $order->status = $request->status;
        $order->totalAll = $request->totalAll;
        $order->user_id = $request->user_id;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->order_note = $request->order_note;
        $order->save();


        foreach ($carts as $cart) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $nextId;

            $orderDetail->product_id = $cart->product_id;
            $orderDetail->oddNamePrd = $cart->name;
            $orderDetail->oddPricePrd = $cart->price;
            $orderDetail->image = $cart->image;
            $orderDetail->oddQuantityPrd = $cart->quantity;
            $orderDetail->save();
            $cart->delete();
        }

        return redirect()->route('orders.show', $request->user_id)->with('success', 'Order successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Order::select('id', 'status', 'date', 'coupon', 'totalAll')->where('user_id', '=', $id)->get();
        // dd($orders);
        return view('client.account', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.orders.edit',[
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all())
        $order = Order::find($id);
        $order->update($request->all());
        return redirect()->route('order.list')->with('alert', 'Update successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('order.list')->with('alert', 'Delete successfully!!');
    }

    public function updateStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->save();
        session()->flash('success', 'Cancel order success!');
        return redirect()->route('order.show', Auth::user()->id);
    }

    public function showAdmin()
    {
        $orders = Order::all();
        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    public function showOrderDetail($id)
    {
        $order = Order::find($id);
        $orderDetail = OrderDetail::where('order_id','=',$id)->get();
        // dd($orderDetail);
        return view('client.order-detail', [
            'order' => $order,
            'orderDetail' => $orderDetail
        ]);
    }
    public function showOrderDetailAdmin($id)
    {
        $order = Order::find($id);
        $orderDetail = OrderDetail::where('order_id','=',$id)->get();
        // dd($orderDetail);
        return view('admin.orders.order-detail', [
            'order' => $order,
            'orderDetail' => $orderDetail
        ]);
    }
}
