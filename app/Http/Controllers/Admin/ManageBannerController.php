<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ManageBannerController extends Controller
{
    public function allBanner()
    {
        $banner = Banner::latest()->get();
        return view('admin.backend.banner.all_banner',compact('banner'));
    }

    public function bannerStore(Request $request)
    {
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(400,400)->save(public_path('upload/banner/'.$name_gen));
            $save_url = 'upload/banner/'.$name_gen;
            Banner::create([
                'url' => $request->url,
                'image' => $save_url,
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function editBanner($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $banner->image = asset($banner->image);
        }
        return response()->json($banner);
    }

    public function bannerUpdate(Request $request)
    {
        $banner_id = $request->banner_id;
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(400,400)->save(public_path('upload/banner/'.$name_gen));
            $save_url = 'upload/banner/'.$name_gen;
            Banner::find($banner_id)->update([
                'url' => $request->url,
                'image' => $save_url,
            ]);

            return redirect()->route('all.banner')->with([
                'message' => 'Banner Updated Successfully',
                'alert-type' => 'success'
            ]);
        }

        Banner::find($banner_id)->update([
            'url' => $request->url,
        ]);


        return redirect()->route('all.banner')->with([
            'message' => 'Banner Updated Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function deleteBanner($id){
        $item = Banner::find($id);
        $img = $item->image;
        unlink($img);
        Banner::find($id)->delete();

        return redirect()->back()->with([
            'message' => 'Banner Delete Successfully',
            'alert-type' => 'success'
        ]);
    }
}
