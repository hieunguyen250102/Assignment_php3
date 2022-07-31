<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id', 'name', 'status', 'image', 'price', 'tag', 'sale_price', 'description', 'image_list', 'status', 'category_id')
            // ->cursorPaginate(5);
            ->paginate(10);
        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|unique:product',
        //     'image' => 'required',
        //     'image_list' => 'required',
        //     'description' => 'required',
        //     'summary' => 'required',
        //     'price' => 'required|alpha_num',
        //     'sale_price' => 'alpha_num',
        //     'tag' => 'required',
        //     'status' => 'required',
        //     'category_id' => 'required',
        // ]);
        $data = $request->all();
        // dd($data);
        if ($request->hasFile('image')) {
            $destination_path = 'public/images/product';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $image_name);
            $data['image'] = $image_name;
        }

        $files = [];
        if ($request->hasFile('image_list')) {
            foreach ($request->file('image_list') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }
        $data['image_list'] = implode(",", $files);

        Product::create($data);
        return redirect()->route('products.index')->with('alert', 'Create successfully!!');
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
        if ($product) {
            $splitImage = explode(",", $product->image_list);
            $product->image_list = $splitImage;
            $splitTag = explode(",", $product->tag);
            $product->tag = $splitTag;
            // $product->summary = preg_replace("/<p(.*?)>/", "", $product->summary);
            // $product->summary = str_replace("</p>", "", $product->summary);
            // $product->description = preg_replace("/<p(.*?)>/", "", $product->description);
            // $product->description = str_replace("</p>", "", $product->description);
            return view('client.product', ['product' => $product]);
        } else {
            return view('errors.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $splitImage = explode(",", $product->image_list);
        $product->image_list = $splitImage;
        return view('admin.products.edit', ['categories' => $categories, 'product' => $product]);
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
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('alert', 'Delete successfully!!');
    }

    public function tag(Request  $request)
    {
        $products = Product::where('status', 0)->where('name', 'LIKE', '%' . $request->tag . '%')
        ->orWhere('tag', 'LIKE', '%' . $request->tag . '%');
    }
}
