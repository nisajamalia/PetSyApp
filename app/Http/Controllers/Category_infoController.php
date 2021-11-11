<?php

namespace App\Http\Controllers;
use App\Models\Category_info;

use Illuminate\Http\Request;

class Category_infoController extends Controller
{
    public function createInfo(Request $request){
        $data = $request->all();
        // $info = new Category_hewan;
        // $info->name = $data['name'];
        // $info->desc = $data['desc'];
        // $info->image = $data['image'];
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }
        Category_info::create($data);
        // $info->save();
        $status = "Success create data Info";
        return response()->json(compact('status', 'data'), 200); 
    }
     //show by id info
     public function showInfo(Category_info $category){
        $status = "succes get data kategori";
    
        return response()->
        json(compact('status','category'), 200);
    }
    public function showKategoriAll(){
        $kategori = Category_info::All();
        $status = "succes get data kategori";
    
        return response()->
        json(compact('status', 'kategori'), 200);
    }
}
