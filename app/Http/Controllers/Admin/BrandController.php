<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Models\Category;

class BrandController extends Controller
{
    public function adminBrand(){
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.brand.index',compact('brands','categories'));
    }

    public function create(){
        $categories = Category::where('status','0')->get();
        return view('admin.brand.create', compact('categories'));
    }

    public function store(BrandFormRequest $request){
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);

         $category->brands()->create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'status' => $request->status == true ? '1' : '0',
            'category_id' => $validatedData['category_id']
        ]);

        return redirect('admin/brand')->with('message','Brand Uploaded Successfully.');
    }
    
    public function edit(Brand $brand){
        $categories = Category::all();
        return view('admin.brand.edit',compact('brand','categories'));
    }

    public function update(BrandFormRequest $request,$brand){
        $validatedData = $request->validated();
        Brand::findOrFail($brand)->update([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'status' => $request->status == true ? '1' : '0',
            'category_id' => $validatedData['category_id']
        ]);

        return redirect('admin/brand')->with('message','Brand Updated Successfully.');
    }

    public function destory(Brand $brand){
        $brand->delete();
        return redirect('admin/brand')->with('message','Brand Deleted.');
    }

}
