<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
    public function allProduct()
    {
        $id = Auth::guard('vendor')->id();
        $product = Product::where('vendor_id',$id)->orderBy('id','desc')->get();
        return view('vendor.backend.product.all_product', compact('product'));
    }

    public function addProduct()
    {
        $id = Auth::guard('vendor')->id();
        $category = Category::latest()->get();
        $city = City::latest()->get();
        $menu = Menu::where('vendor_id',$id)->latest()->get();
        return view('vendor.backend.product.add_product', compact('category','city','menu'));
    }

    public function StoreProduct(Request $request)
    {
        $pcode = IdGenerator::generate(['table' => 'products','field' => 'code', 'length' => 5, 'prefix' => 'PC']);
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', more_entropy: false)).'.'.$image->getClientOriginalExtension();
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
                'vendor_id' => Auth::guard('vendor')->id(),
                'most_popular' => $request->most_popular,
                'best_seller' => $request->best_seller,
                'status' => 1,
                'created_at' => Carbon::now(),
                'image' => $save_url,
            ]);
        }

        return redirect()->route('all.product')->with([
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function editProduct($id){
        $cid = Auth::guard('vendor')->id();
        $category = Category::latest()->get();
        $city = City::latest()->get();
        $menu = Menu::where('vendor_id',$cid)->latest()->get();
        $product = Product::find($id);
        return view('vendor.backend.product.edit_product', compact('category','city','menu','product'));
    }

    public function updateProduct(Request $request){
        $pro_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', more_entropy: false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/product/'.$name_gen));
            $save_url = 'upload/product/'.$name_gen;

            Product::find($pro_id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ','-',$request->name)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
                'qty' => $request->qty,
                'size' => $request->size,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'most_popular' => $request->most_popular,
                'best_seller' => $request->best_seller,
                'created_at' => Carbon::now(),
                'image' => $save_url,
            ]);

            return redirect()->route('all.product')->with([
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
            'qty' => $request->qty,
            'size' => $request->size,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'most_popular' => $request->most_popular,
            'best_seller' => $request->best_seller,
            'created_at' => Carbon::now(),
        ]);


        return redirect()->route('all.product')->with([
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function deleteProduct($id)
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

    public function changeStatus(Request $request){
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => 'Status Change Successfully']);
    }
}
