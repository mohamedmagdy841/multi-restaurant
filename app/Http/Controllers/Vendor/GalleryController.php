<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class GalleryController extends Controller
{
    public function allGallery()
    {
        $cid = Auth::guard('vendor')->id();
        $gallery = Gallery::where('vendor_id',$cid)->latest()->get();
        return view('vendor.backend.gallery.all_gallery', compact('gallery'));
    }

    public function addGallery()
    {
        return view('vendor.backend.gallery.add_gallery' );
    }

    public function storeGallery(Request $request)
    {
        $images = $request->file('gallery_img');
        foreach ($images as $gimg) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', more_entropy: false)).'.'.$gimg->getClientOriginalExtension();
            $img = $manager->read($gimg);
            $img->resize(800,800)->save(public_path('upload/gallery/'.$name_gen));
            $save_url = 'upload/gallery/'.$name_gen;
            Gallery::insert([
                'vendor_id' => Auth::guard('vendor')->id(),
                'gallery_img' => $save_url,
            ]);
        }

        return redirect()->route('all.gallery')->with([
            'message' => 'Gallery Inserted Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function editGallery($id)
    {
        $gallery = Gallery::find($id);
        return view('vendor.backend.gallery.edit_gallery',compact('gallery'));
    }
    // End Method
    public function updateGallery(Request $request)
    {
        $gallery_id = $request->id;
        if ($request->hasFile('gallery_img')) {
            $image = $request->file('gallery_img');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid('', false)).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(800,800)->save(public_path('upload/gallery/'.$name_gen));
            $save_url = 'upload/gallery/'.$name_gen;
            $gallery = Gallery::find($gallery_id);
            if ($gallery->gallery_img) {
                $img = $gallery->gallery_img;
                unlink($img);
            }
            $gallery->update([
                'gallery_img' => $save_url,
            ]);

            return redirect()->route('all.gallery')->with([
                'message' => 'Menu Updated Successfully',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'No Image Selected for Update',
            'alert-type' => 'warning'
        ]);
    }
    public function deleteGallery($id){
        $item = Gallery::find($id);
        $img = $item->gallery_img;
        unlink($img);
        Gallery::find($id)->delete();

        return redirect()->back()->with([
            'message' => 'Gallery Delete Successfully',
            'alert-type' => 'success'
        ]);
    }
}
