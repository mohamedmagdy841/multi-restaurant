<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MenuController extends Controller
{
    public function allMenu()
    {
        $id = Auth::guard('vendor')->id();
        $menu = Menu::where('vendor_id',$id)->orderBy('id','desc')->get();
        return view('vendor.backend.menu.all_menu', compact('menu'));
    }

    public function addMenu()
    {
        return view('vendor.backend.menu.add_menu');
    }

    public function storeMenu(Request $request)
    {
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/menu/'.$name_gen));
            $save_url = 'upload/menu/'.$name_gen;
            Menu::create([
                'menu_name' => $request->menu_name,
                'vendor_id' => Auth::guard('vendor')->id(),
                'image' => $save_url,
            ]);
        }

        return redirect()->route('all.menu')->with([
            'message' => 'Menu Inserted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function editMenu($id)
    {
        $menu = Menu::find($id);
        return view('vendor.backend.menu.edit_menu', compact('menu'));
    }

    public function updateMenu(Request $request)
    {
        $menu_id = $request->id;
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/menu/'.$name_gen));
            $save_url = 'upload/menu/'.$name_gen;
            Menu::find($menu_id)->update([
                'menu_name' => $request->menu_name,
                'image' => $save_url,
            ]);

            return redirect()->route('all.menu')->with([
                'message' => 'Menu Updated Successfully',
                'alert-type' => 'success'
            ]);
        }

        Menu::find($menu_id)->update([
            'menu_name' => $request->menu_name,
        ]);

        return redirect()->route('all.menu')->with([
            'message' => 'Menu Updated Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function deleteMenu($id)
    {
        $item = Menu::find($id);
        $img = $item->image;
        unlink($img);
        Menu::find($id)->delete();

        return redirect()->back()->with([
            'message' => 'Menu Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
