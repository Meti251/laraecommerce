<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    //
    public function index(){
        return view('admin.category.index');

    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(CategoryFormRequest $request)
    {
        $validateData= $request->validated();
        $category=new Category;
        $category-> name=$validateData['name'];
        $category-> slug=Str::slug($validateData['slug']);
        $category-> description=$validateData['description'];

        $uploadPath = 'uploads/category/';
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $ext= $file->getClientOriginalExtension();
            $filename =time().'.'.$ext;

            $file->move('uploads/category/',$filename);
            $category->image = $uploadPath.$filename;

        }
        $category->  $filename;

        $category-> meta_title=$validateData['meta_title'];
        $category-> meta_keyword=$validateData['meta_keyword'];
        $category-> meta_description=$validateData['meta_description'];

        $category->status=$request->status==true?'1':'0';
        $category->save();

        return redirect('admin/category')->with('message','category added sucessfully');
    }
    public function edit(Category $category)
    {
        //return $category;
        return view('admin.category.edit',compact('category'));

    }

    public function update(CategoryFormRequest $request, $id)
    {
        // Validate the request data
         $validateData = $request->validated();
        $category=Category::findOrFail($id);

        // Update category attributes
            $category->name = $validateData['name'];
            $category->slug = Str::slug($validateData['slug']);
            $category->description = $validateData['description'];

            if ($request->hasFile('image')) {
                // Delete existing image
                $uploadPath = 'uploads/category/';
                $path = 'uploads/category/' . $category->image;
                if (File::exists($path)) {
                    File::delete($path);
                }

                // Upload and save new image
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('uploads/category/', $filename);
                $category->image = $uploadPath.$filename;
            }

            $category->meta_title = $validateData['meta_title'];
            $category->meta_keyword = $validateData['meta_keyword'];
            $category->meta_description = $validateData['meta_description'];
            $category->status = $request->has('status') ? '1' : '0';

            $category->save();

            return redirect('admin/category')->with('message', 'Category updated successfully');
    }

}
