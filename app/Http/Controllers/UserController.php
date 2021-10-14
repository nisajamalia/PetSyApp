<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Register
    public function registerUser(Request $request){
        $data = $request->only(['name','email','password','telepon']);
        $validator = Validator::make(
            $data,
            [
                'name' => 'required|string|max:100',
                'email'=> 'required|email|unique:users,email',
                'password'=> 'required|string|min:6',
                'telepon'=> 'required|string|min:12',
            ]
        );
            if($validator->fails()){
                $error = $validator->errors();
                return response()->json(compact('error'), 401);
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->telepon = $request->telepon;
            $user->password = Hash::make($request->password);
            $user->save();

            $status = "success register user";
            return response()->json(compact('status', 'user'), 200);
        }
    //login
    public function loginUser(Request $request){
        //mencari user dari inputan user menggunakan email
        $user = User::where('email', $request['email'])->first();

        if($user && Hash::check($request->password, $user->password)){
            //membuat token for login
            //str= supaya token tidak terbaca
            $token = Str::random(60);
            $user->remember_token = $token;
            $user->save();

            return response()->json([
                'status'=> 200,
                'message'=> 'success',
                'token'=> $token,
                'user'=> $user
            ], 200);
        }
        return response()->json([
            'status'=>   401,
            'message'=>'failed',
        ], 401);
    }

    //Logout
    public function logoutUser(Request $request){
        //mencari user menggunakan token
        $user = User::where('remember_token', 
        $request->bearerToken())->first();
        
        if($user){
            $user->remember_token = null;
            $user->save();
            return response()->json([
                'status'=>200,
                'message'=>'success',
            ], 200);
        }
        return response()->json([
            'status'=>401,
            'message'=>'failed',
        ], 401);
    }
    
        //Update user 
        public function updateUser(Request $request, $id){
            $user = User::find($id);
            $data = $request->all();
            if(isset($request->name)){
                $user->name = $data['name'];
            }
            if(isset($request->email)){
                $user->email = $data['email'];
            }
            if(isset($request->password)){
                $user->password = Hash::make($data['password']);
            }
            if(isset($request->telepon)){
                $user->telepon = $data['telepon'];
            }
            $user->save();
            return response()->json(compact('user'), 200);
        }
        //Get User
        public function getUser($id){
            $user = User::find($id);
            return response()->json(compact('user'), 200);
        }
    }
