<?php

namespace App\Http\Controllers\RegisteredUser;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function show($id){
        
        
        $galleries = Gallery::where('apartment_id','=',$id)->get();
        return view('user.galleries.index', compact('galleries'));

    }

    public function destroy(Gallery $gallery){

        $id_gal=$gallery->apartment_id;
        $gallery->delete();
        return redirect()->route('user.gallery.show', $id_gal);

    }
}
