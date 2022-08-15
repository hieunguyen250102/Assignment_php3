<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
// session_start();

class ShopController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::where('status', '=', 1)
            ->paginate(12);
        // $string = '$360 - $500';
        // $string = explode(' - $', $string);
        // $string[0] = ltrim($string[0], '$');
        // dd($string);
        foreach ($products as $product) {
            $product->summary = preg_replace("/<p(.*?)>/", "", $product->summary);
            $product->summary = str_replace("</p>", "", $product->summary);
            $product->description = preg_replace("/<p(.*?)>/", "", $product->description);
            $product->description = str_replace("</p>", "", $product->description);
        }

        return view('client.shop', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function searchFilter(Request $request)
    {
        if ($request->ajax()) {
            $products = new Product();
            if (isset($request->minimum_price) || isset($request->maximum_price)) {
                $products->whereBetween('price', [$request->minimum_price, $request->maximum_price]);
            }
            if (isset($request->category_id)) {
                $products->where('category_id', '=', $request->category_idF);
            }
            $categories = Category::all();
            $products->where('status', '=', 1);
            foreach ($products as $product) {
                $product->summary = preg_replace("/<p(.*?)>/", "", $product->summary);
                $product->summary = str_replace("</p>", "", $product->summary);
                $product->description = preg_replace("/<p(.*?)>/", "", $product->description);
                $product->description = str_replace("</p>", "", $product->description);
            }
            if ($products) {
                $output = '';
                foreach ($products as $key => $product) {
                    $output .= '
                        <div class="col-xl-4 col-sm-6 col-12">
                        <div class="product-default-single-item product-color--golden" data-aos="fade-up" data-aos-delay="0">
                            <div class="image-box">
                                <a href="' . route('shop.show', $product->id) . '" class="image-link">
                                    <img src="' . asset('storage/images/product/' . $product->image) . '" alt="">
                                    <img src="' . asset('storage/images/product/' . $product->image) . '" alt="">
                                </a>
                                <div class="action-link">
                                    <div class="action-link-left">
                                        <a onclick="addToCart(<?php echo $product->id ?>)" href="javascript:0" id="btn-add-to-cart" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                        <!-- data-bs-toggle="modal" data-bs-target="#modalAddcart" -->
                                    </div>
                                    <div class="action-link-right">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                        <a href="wishlist.html"><i class="icon-heart"></i></a>
                                        <a href="compare.html"><i class="icon-shuffle"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="content-left">
                                    <h6 class="title"><a href="' . route('shop.show', $product->id) . '">' . $product->name . '</a></h6>
                                    <ul class="review-star">
                                        <li class="fill"><i class="ion-android-star"></i>
                                        </li>
                                        <li class="fill"><i class="ion-android-star"></i>
                                        </li>
                                        <li class="fill"><i class="ion-android-star"></i>
                                        </li>
                                        <li class="fill"><i class="ion-android-star"></i>
                                        </li>
                                        <li class="empty"><i class="ion-android-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="content-right">
                                    <span class="price">$ ' . $product->price . '</span>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
                }
            }
            return Response($output);
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

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $products = DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get();
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '
                    <div class="col-xl-4 col-sm-6 col-12">
                    <div class="product-default-single-item product-color--golden" data-aos="fade-up" data-aos-delay="0">
                        <div class="image-box">
                            <a href="' . route('shop.show', $product->id) . '" class="image-link">
                                <img src="' . asset('storage/images/product/' . $product->image) . '" alt="">
                                <img src="' . asset('storage/images/product/' . $product->image) . '" alt="">
                            </a>
                            <div class="action-link">
                                <div class="action-link-left">
                                    <a onclick="addToCart(<?php echo $product->id ?>)" href="javascript:0" id="btn-add-to-cart" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                    <!-- data-bs-toggle="modal" data-bs-target="#modalAddcart" -->
                                </div>
                                <div class="action-link-right">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="content-left">
                                <h6 class="title"><a href="' . route('shop.show', $product->id) . '">' . $product->name . '</a></h6>
                                <ul class="review-star">
                                    <li class="fill"><i class="ion-android-star"></i>
                                    </li>
                                    <li class="fill"><i class="ion-android-star"></i>
                                    </li>
                                    <li class="fill"><i class="ion-android-star"></i>
                                    </li>
                                    <li class="fill"><i class="ion-android-star"></i>
                                    </li>
                                    <li class="empty"><i class="ion-android-star"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="content-right">
                                <span class="price">$ ' . $product->price . '</span>
                            </div>
                        </div>
                    </div>
                </div>
            ';
                }
            }

            return Response($output);
        }
    }
}
