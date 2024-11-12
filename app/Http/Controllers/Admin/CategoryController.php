<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $category = Category::latest()->get();
        return view('admin.backend.category.all_category', compact('category'));
    }

    public function addCategory()
    {
        return view('admin.backend.category.add_category');
    }

    public function storeCategory(Request $request)
    {
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/category/'.$name_gen));
            $save_url = 'upload/category/'.$name_gen;
            Category::create([
                'category_name' => $request->category_name,
                'image' => $save_url,
            ]);
        }

        return redirect()->route('all.category')->with([
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('admin.backend.category.edit_category', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $cat_id = $request->id;
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/category/'.$name_gen));
            $save_url = 'upload/category/'.$name_gen;

            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                'image' => $save_url,
            ]);

            return redirect()->route('all.category')->with([
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            ]);
        }

        Category::find($cat_id)->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('all.category')->with([
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function DeleteCategory($id)
    {
        $item = Category::find($id);
        $img = $item->image;
        unlink($img);
        Category::find($id)->delete();

        return redirect()->back()->with([
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

}
