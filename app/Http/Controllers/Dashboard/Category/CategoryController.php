<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    private function getData(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->post('name')),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'parent_id' => $request->input('parent_id'),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName() . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.' . $file->getClientOriginalExtension();
                $folderName = $request->name;
                $path = $file->storeAs("categories-images/$folderName", $filename, 'uploads');
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
        $categories = Category::with('products')
                ->withCount('products')->paginate();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $status = Category::getStatus();
        $parents = Category::all();
        return view('dashboard.categories.create' , compact('category' , 'status' , 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $this->getData($request);
        Category::create($data);

        return redirect()->route('dashboard.categories.index')
                    ->with('success' , 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $products = Product::where('category_id' , $category->id)->get();
        return view('dashboard.categories.show' , compact('category' , 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $status = Category::getStatus();
        $parents = Category::all();
        return view('dashboard.categories.edit' , 
        compact('category' , 'status' , 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $this->getData($request);
        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('uploads')->exists($category->image)) {
                Storage::disk('uploads')->delete($category->image);
            }
        }
        $category->update($data);

        return redirect()->route('dashboard.categories.index')
                    ->with('success' , 'Category updated successfully');
  
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        if($category->image)
        {
            Storage::disk('uploads')->delete($category->image);
            
            $folderName = dirname($category->image);

            if (Storage::disk('uploads')->exists($folderName)) 
            {
                Storage::disk('uploads')->deleteDirectory($folderName);
            }
        }
        return redirect()->route('dashboard.categories.index')
                    ->with('success' , 'Category deleted successfully');
    }
  
}
