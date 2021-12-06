<?php

namespace App\Http\Controllers;
use App\Models\Postingan;
use App\Models\User;
use App\Models\Category_hewan;
use Illuminate\Http\Request;

class PostinganController extends Controller
{
    public function createPost(Request $request) {
        $data = $request->all();
        
        // $post = new Postingan;
        // $post->user_id = $data['user_id'];
        // $post->description = $data['description'];
        // $post->lokasi = $data['lokasi'];
        // $post->category_id = $data['category_id'];
        // $post->status = $data['status'];
        // $post->image = $data['image'];

        $request->validate([
            'user_id' => 'required',
            'description' => 'required',
            'lokasi' => 'required',
            // 'category_id' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori'=> 'required',
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }

        Postingan::create($data);
        // $post->save();
        $status = "Success create data postingan";
        return response()->json(compact('status','data'), 200);
        
    }
    //filter category
// public function list(Request $request){
//     $categories=Postingan::with(['kategori']);
//     if($request->kategori){
//         $categories->whereHas('kategori',function($query) use($request){
//             $query->where('kategori',$request->kategori);
//         });
  
//     }
//     $blogs=$categories->get();
//     return response()->json([
//         'message'=>'Category successfully fetched',
//         'data'=>$blogs
//     ],200);
// }
    
    
    public function showPost(Postingan $post){
        //manggil komentar biar munculin postingan ada komentarnya jg 
        $status = "succes get data post";
    
        return response()->
        json(compact('status','post'), 200);
    
}

public function updatePost(Request $request, Postingan $post){
    $data = $request->all();
    if(isset($data['user_id'])&& !empty($data['user_id'])){
        $post->user_id = $data['user_id'];

    }
    if(isset($data['image'])&& !empty($data['image'])){
        $post->image = $data['image'];
    }
    if(isset($data['description'])&& !empty($data['description'])){
        $post->description = $data['description'];

    }
    if(isset($data['lokasi'])&& !empty($data['lokasi'])){
        $post->lokasi = $data['lokasi'];

    }
    // if(isset($data['category_id'])&& !empty($data['category_id'])){
    //     $post->category_id = $data['category_id'];

    // }
    if(isset($data['status'])&& !empty($data['status'])){
        $post->status = $data['status'];

    }
    if(isset($data['kategori'])&& !empty($data['kategori'])){
        $post->kategori = $data['kategori'];

    }
    
    $post->save();
    $status = "success update data postingan";
    return response()->json(compact('status','post'), 200);
}

public function deletePost(Postingan $post){
    $post->delete();
    $status = "success delete data postingan";
    return response()->json(compact('status'), 200);
    }   

public function search($description){
    return Postingan::where("description","like","%".$description."%")->get();

    }
public function filter($kategori){
        return Postingan::where("kategori","like","%".$kategori."%")->get();
    
    }
}

// function search($data){
//     $data = Postingan::All();
//     return Postingan::where("description","like","%".$data."%")->get();
//     $status = "success mengambil data ";
//     return response()->json(compact('status','data'), 200);
//     }

