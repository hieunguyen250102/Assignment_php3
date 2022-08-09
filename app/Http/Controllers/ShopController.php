<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
// session_start();

class ShopController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct(Request $request)
    // {
    //     $newCart = $request->session()->get('Cart');
    //     if (!isset($newCart)) {
    //         return false;
    //     } else {
    //         $output = '';
    //         $count = 0;
    //         foreach ($newCart->products as $item) {
    //             $count++;
    //             $output .= '
    //         <li class="offcanvas-cart-item-single">
    //         <div class="offcanvas-cart-item-block">
    //             <a href="#" class="offcanvas-cart-item-image-link">
    //                 <img src=" ' . asset('storage/images/product/' . $item['productInfo']->image) . '" alt="" class="offcanvas-cart-image">
    //             </a>
    //             <div class="offcanvas-cart-item-content">
    //                 <a href="#" class="offcanvas-cart-item-link">' . $item['productInfo']->name . '</a>
    //                 <div class="offcanvas-cart-item-details">
    //                     <span class="offcanvas-cart-item-details-quantity">' . $item['quantity'] . ' x </span>
    //                     <span class="offcanvas-cart-item-details-price">$' . $item['productInfo']->price . '</span>
    //                 </div>
    //             </div>
    //         </div>
    //         <div class="offcanvas-cart-item-delete text-right">
    //             <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
    //         </div>
    //     </li>
    //         ';
    //         }

    //         $total = '
    //     <div class="offcanvas-cart-total-price">
    //         <span class="offcanvas-cart-total-price-text">Subtotal:</span>
    //         <span class="offcanvas-cart-total-price-value">$' . $newCart->totalPrice . '</span>
    //     </div>';
    //         $result = '<ul class="offcanvas-cart">' . $output . $total . '</ul>';
    //         $quantityCount = '
    //     <i class="icon-bag"></i>
    //     <span class="item-count bag">' . $count . '</span>';
    //         return Response([$result, $quantityCount]);
    //     }
    // }
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('status','=',1)
        ->paginate(12);
        foreach ($products as $product) {
            $product->summary = preg_replace("/<p(.*?)>/", "", $product->summary);
            $product->summary = str_replace("</p>", "", $product->summary);
            $product->description = preg_replace("/<p(.*?)>/", "", $product->description);
            $product->description = str_replace("</p>", "", $product->description);
        }

        return view('client.shop', [
            'categories' => $categories,
            'products' => $products
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
        $product = Product::find($id);
        $comments = Comment::select('comments.*', 'users.firtsname', 'users.lastname', 'users.avatar')->join('users', 'comments.user_id', '=', 'users.id')->where('product_id', '=', $id)->get();
        $product['image_list'] = explode(',', $product['image_list']);
        $product['tag'] = explode(',', $product['tag']);
        $product->summary = preg_replace("/<p(.*?)>/", "", $product->summary);
        $product->summary = str_replace("</p>", "", $product->summary);
        $product->description = preg_replace("/<p(.*?)>/", "", $product->description);
        $product->description = str_replace("</p>", "", $product->description);
        return view('client.product', [
            'product' => $product,
            'comments' => $comments
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
}
