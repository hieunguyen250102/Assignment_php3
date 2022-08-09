<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $totalAll = 0;
        if(Auth::check()) {
            $carts = Cart::select('cart.*', 'products.name', 'products.image', 'products.price')->join('products', 'cart.product_id', '=', 'products.id')->where('user_id', '=', Auth::user()->id)->get();
            return view('client.cart', [
                'carts' => $carts,
                'totalAll' => $totalAll
            ]);
        } else {
            return view('errors.cart-empty');
        }
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
        $cartModel = new Cart();
        $carts = DB::table('cart')->where('user_id', '=', Auth::user()->id)->get();
        foreach ($carts as $cart) {
            if ($request->product_id == $cart->product_id) {
                $cartId = Cart::select('cart.*', 'products.name', 'products.image', 'products.price')->join('products', 'cart.product_id', '=', 'products.id')->where('cart.product_id', '=', $request->product_id)->get();
                $newQuantity = $cart->quantity + $request->quantity;
                $id = $cartId->pluck('id');
                Cart::whereIn('id', $id)->update(['quantity' => $newQuantity]);
                return redirect()->route('cart.index');
            }
        }

        $cartModel->fill($request->all());
        $cartModel->save();
        return redirect()->route('cart.index');
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
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->route('cart.index');
    }




    public function addCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = Product::find($id);
            if ($product !== null) {
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
                foreach (session('cart') as $item) {
                    $count++;
                }
                $quantityCount = '
                <i class="icon-bag"></i>
                <span class="item-count bag">' . $count . '</span>';
                return Response($quantityCount);

                foreach (session('cart') as $id => $proItem) {
                    // $item = Cart::where('product_id', '=', $product->id)->where('user_id', '=', Auth::user()->id)->orWhere('user_id', '=', 0)->get();
                    // $item = count($item) ? $item[0] : null;
                    $user_id = Auth::user() ? Auth::user()->id : 0;
                    $cart = new Cart();
                    $cart->product_id = $id;
                    $cart->quantity = $proItem[$id]['quantity'];
                    $cart->user_id = $user_id;
                    $cart->save();
                    // } else {
                    //     // dd($item);
                    //     // $item->discount = $item->discount + $qty;
                    //     // $item->save();
                    // }
                    // $cart = new Cart();
                    // $cart->product_id = $id;
                    // $cart->quantity = $item['quantity'];
                    // $cart->user_id = 0;
                    // $cart->save();
                }


                return redirect()->back()->with('success', 'Product added to cart successfully!');
                // return view('client.cart', compact('newCart'));

                // foreach ($newCart->products as $item) {
                //     $count++;
                //     $output .= '
                //     <li class="offcanvas-cart-item-single">
                //     <div class="offcanvas-cart-item-block">
                //         <a href="#" class="offcanvas-cart-item-image-link">
                //             <img src=" ' . asset('storage/images/product/' . $item['productInfo']->image) . '" alt="" class="offcanvas-cart-image">
                //         </a>
                //         <div class="offcanvas-cart-item-content">
                //             <a href="#" class="offcanvas-cart-item-link">' . $item['productInfo']->name . '</a>
                //             <div class="offcanvas-cart-item-details">
                //                 <span class="offcanvas-cart-item-details-quantity">' . $item['quantity'] . ' x </span>
                //                 <span class="offcanvas-cart-item-details-price">$' . $item['productInfo']->price . '</span>
                //             </div>
                //         </div>
                //     </div>
                //     <div class="offcanvas-cart-item-delete text-right">
                //         <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                //     </div>
                // </li>
                //     ';
                // }

                // $total = '
                // <div class="offcanvas-cart-total-price">
                //     <span class="offcanvas-cart-total-price-text">Subtotal:</span>
                //     <span class="offcanvas-cart-total-price-value">$' . $newCart->totalPrice . '</span>
                // </div>';
                // $result = '<ul class="offcanvas-cart">' . $output . $total . '</ul>';
                // $quantityCount = '
                // <i class="icon-bag"></i>
                // <span class="item-count bag">' . $count . '</span>';
            }
        }
        // return Response([$result, $quantityCount]);
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function deleteCart(Request $request, $id)
    {
        $cart = session()->get('cart');
        $request->session()->forget('cart');
        // unset(session('cart')[$id]);
        if (count(session('cart')) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            $request->session()->forget('cart');
        }
    }
}
