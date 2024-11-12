<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Vendor;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ManageProductController extends Controller
{
    public function adminAllProduct()
    {
        $product = Product::orderBy('id','desc')->get();
        return view('admin.backend.product.all_product', compact('product'));
    }

    public function adminAddProduct()
    {
        $category = Category::latest()->get();
        $city = City::latest()->get();
        $menu = Menu::latest()->get();
        $vendor = Vendor::latest()->get();
        return view('admin.backend.product.add_product', compact('category','city','menu','vendor'));
    }

    public function adminStoreProduct(Request $request)
    {
        $pcode = IdGenerator::generate(['table' => 'products','field' => 'code', 'length' => 5, 'prefix' => 'PC']);
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/product/'.$name_gen));
            $save_url = 'upload/product/'.$name_gen;
            Product::create([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ','-',$request->name)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
                'code' => $pcode,
                'qty' => $request->qty,
                'size' => $request->size,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'vendor_id' => $request->vendor_id,
                'most_popular' => $request->most_popular,
                'best_seller' => $request->best_seller,
                'status' => 1,
                'created_at' => Carbon::now(),
                'image' => $save_url,
            ]);
        }

        return redirect()->route('admin.all.product')->with([
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function adminEditProduct($id)
    {
        $category = Category::latest()->get();
        $city = City::latest()->get();
        $menu = Menu::latest()->get();
        $vendor = Vendor::latest()->get();
        $product = Product::find($id);
        return view('admin.backend.product.edit_product', compact('category','city','menu','product','vendor'));
    }

    public function adminUpdateProduct(Request $request)
    {
        $pro_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/product/'.$name_gen));
            $save_url = 'upload/product/'.$name_gen;
            Product::find($pro_id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ','-',$request->name)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
                'vendor_id' => $request->vendor_id,
                'qty' => $request->qty,
                'size' => $request->size,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'most_popular' => $request->most_popular,
                'best_seller' => $request->best_seller,
                'created_at' => Carbon::now(),
                'image' => $save_url,
            ]);

            return redirect()->route('admin.all.product')->with([
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
            ]);
        }

        Product::find($pro_id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ','-',$request->name)),
            'category_id' => $request->category_id,
            'city_id' => $request->city_id,
            'menu_id' => $request->menu_id,
            'vendor_id' => $request->vendor_id,
            'qty' => $request->qty,
            'size' => $request->size,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'most_popular' => $request->most_popular,
            'best_seller' => $request->best_seller,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.all.product')->with([
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function adminDeleteProduct($id)
    {
        $item = Product::find($id);
        $img = $item->image;
        unlink($img);
        Product::find($id)->delete();

        return redirect()->back()->with([
            'message' => 'Product Delete Successfully',
            'alert-type' => 'success'
        ]);
    }
}
