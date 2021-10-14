<?php

namespace App\Http\Controllers;
use App\Models\Category_hewan;
use App\Models\Postingan;


use Illuminate\Http\Request;

class Category_hewanController extends Controller
{
    public function createKategori(Request $request){
        $data = $request->all();
        $kategori = new Category_hewan;
        $kategori->title = $data['title'];
        $kategori->save();
        $status = "Success create data Kategori";
        return response()->json(compact('status', 'kategori'), 200); 
    }

    //show by id category
    public function showKategori(Category_hewan $category){
        $status = "succes get data kategori";
    
        return response()->
        json(compact('status','category'), 200);
    }
    
    public function showKategoriAll(){
        $kategori = Category_hewan::All();
        $status = "succes get data kategori";
    
        return response()->
        json(compact('status', 'kategori'), 200);
    }
}
