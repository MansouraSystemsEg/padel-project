<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private function getData(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->post('name')),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'compare_price' => $request->input('compare_price'),
            'quantity' => $request->input('quantity'),
            // 'rating' => $request->input('rating'),
            // 'featured' => $request->input('featured'),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName() . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.' . $file->getClientOriginalExtension();
                $folderName = $request->name;
                $path = $file->storeAs("products-images/$folderName", $filename, 'uploads');
                $data['image'] = $path;
            }
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate();
        return view('dashboard.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::pluck('name' , 'id');
        $status = Product::getStatus();
        return view('dashboard.products.create' , compact('product' , 'categories' , 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $this->getData($request);
        Product::create($data);

        return redirect()->route('dashboard.products.index')
                    ->with('success' , 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::where('id', $product->id)->all();
        return view('dashboard.products.show' , compact('product' , 'categories'));
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('name' , 'id');
        $status = Product::getStatus();
        return view('dashboard.products.edit' , compact('product' , 'categories', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $this->getData($request);
        if ($request->hasFile('image')) {
            if (!empty($product->image) && file_exists(public_path($product->image))) {
                Storage::disk('uploads')->delete($product->image);
            }
        }
        $product->update($data);
        return redirect()->route('dashboard.products.index')
                    ->with('success' , 'Product updated successfully');
    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if ($product->image) {
            Storage::disk('uploads')->delete($product->image);
            $folderName = dirname($product->image);
            if (Storage::disk('uploads')->exists($folderName)) {
                Storage::disk('uploads')->deleteDirectory($folderName);
            }
        }
        return redirect()->route('dashboard.products.index')
                    ->with('success' , 'Product deleted successfully');
    }
   
}
