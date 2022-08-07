<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
// session_start();
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('client.cart');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = Product::find($id);
            if ($product !== null) {
                // if ($request->session()->has('Cart')) {
                //     $oldCart = Session('Cart');
                // } else {
                //     $oldCart = null;
                // }
                // // $oldCart = Session('Cart') ? Session('Cart') : null;
                // $newCart = new Cart($oldCart);
                // $newCart->addCart($product, $id);
                // $request->session()->put('Cart', $newCart);
                // $output = '';
                $count = 0;
                $cart = session()->get('cart', []);

                if (isset($cart[$id])) {
                    $cart[$id]['quantity']++;
                } else {
                    $cart[$id] = [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "image" => $product->image
                    ];
                }
                session()->put('cart', $cart);
                foreach (session('cart') as $items) {
                    $item = Cart::where('product_id', '=', $product->id)
                        ->where('user_id', '=', Auth::user()->id)
                        ->orWhere('user_id', '=', 0)->get();
                    $item = count($item) ? $item[0] : null;
                    $count++;
                    if ($item == null) {
                        $cart = new Cart();
                        $cart->product_id = $id;
                        $cart->quantity = $items['quantity'];
                        $cart->user_id = 0;
                        $cart->save();
                    } else {
                        $cart->quantity = $items['quantity'];
                        $cart->save();
                    }
                }
                $quantityCount = '
                <i class="icon-bag"></i>
                <span class="item-count bag">' . $count . '</span>';
                return Response($quantityCount);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
        }
        // return Response([$result, $quantityCount]);
    }
}
