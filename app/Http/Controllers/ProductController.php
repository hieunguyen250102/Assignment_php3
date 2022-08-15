<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        $data = $request->all();
        
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
                $file->move(public_path('images/product'), $name);
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
            $product->summary = preg_replace("/<p(.*?)>/", "", $product->summary);
            $product->summary = str_replace("</p>", "", $product->summary);
            $product->description = preg_replace("/<p(.*?)>/", "", $product->description);
            $product->description = str_replace("</p>", "", $product->description);
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
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);

        // $splitImage = explode(",", $product->image_list);
        // $product->image_list = $splitImage;

        $data = $request->all();
        // dd($data);
        if ($request->hasFile('image')) {
            $destination_path = 'public/images/product';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $image_name);
            $data['image'] = $image_name;
        } else {
            $data['image'] = $product->image;
        }

        $files = [];
        if ($request->hasFile('image_list')) {
            foreach ($request->file('image_list') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('images/product'), $name);
                $files[] = $name;
            }
        } else {
            $data['image_list'] = $product->image_list;
        }
        // $data['image_list'] = implode(",", $files);

        if (!($request->tag)) {
            $data['tag'] = $product->tag;
        }
        $product->update($data);
        return redirect()->route('products.index')->with('alert', 'Update successfully!!');
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

    public function tag(Request $request)
    {
        $categories = Category::all();
        $products = Product::where('status', 1)->where('name', 'LIKE', '%' . $request->tag . '%')
            ->orWhere('tag', 'LIKE', '%' . $request->tag . '%')->paginate(12);
        if (count($products)) {
            foreach ($products as $product) {
                $product->summary = preg_replace("/<p(.*?)>/", "", $product->summary);
                $product->summary = str_replace("</p>", "", $product->summary);
                $product->description = preg_replace("/<p(.*?)>/", "", $product->description);
                $product->description = str_replace("</p>", "", $product->description);
            }
        } else {
            $products = null;
        }
        return view('client.tag', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function updateStatusProduct(Product $Product, Request $request)
    {
        // dd($request->status);
        $Product = Product::find($request->id);
        $Product->fill($request->all());
        $Product->save();
        return redirect()->route('products.index')->with('alert', 'Update status successfully!!');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $products = DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get();
            if ($products) {
                foreach ($products as $product) {
                    $output .= '
                    <tr>
                    <td>
                        <div class="checkbox checkbox-dark">
                            <input id="solid" type="checkbox" value="' . $product->id . '">
                            <label for="solid"></label>
                        </div>
                    </td>
                    <th scope="row">' . $product->id . '</th>
                    <td>' . $product->name . '</td>
                    <td>
                        <img width="100px" src="' . asset('storage/images/product/' . $product->image) . '" alt="">
                    </td>';
                    if ($product->status == 0) {
                        $status = '<td>
                        <a href="' . route('admin.updateStatusProduct', ['id' => $product->id, 'status' => 1]) . '" class="btn btn-info"><i class="fa-solid fa-eye-slash"></i></a>
                    </td>';
                    } else {
                        $status = ' <td>
                        <a href="' . route('admin.updateStatusProduct', ['id' => $product->id, 'status' => 0]) . '" class="btn btn-light"><i class="fa-solid fa-eye"></i></a>
                    </td>';
                    }
                    $option = '
                    <td>
                        <a href="' . route('products.edit', ['product' => $product->id]) . '">
                            <button class="btn btn-warning">Edit</button>
                        </a>
                    </td>
                    <td>
                        <a href="' . route('products.destroy', ['product' => $product->id]) . '" class="btn btn-danger btnDelete">Delete</a>
                    </td>
                </tr>';
                }
            }
            return Response($output . $status . $option);
        }
    }
}
