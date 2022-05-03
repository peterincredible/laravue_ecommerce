<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
   public function Signup(){
        $rules=[
            'name'=>'required|min:3|max:25',
            'email'=>'required|email',
            'password'=>'required|min:6'
        ];
        $message=[
            'required'=>'the :attribute field is required',
            'email'=>'the :attribute must be a valid email',
            'min'=>'the :attribute must be a minimum of 6 words'
        ];
        $validator = Validator::make(request()->all(),$rules,$message);
    
        if($validator->fails()){
            return response()->json($validator->errors())->setStatusCode(400);
        }
        
         $validated = $validator->validated();
         //check if email already existed
        //  $already_found_email = User::where('email',$validated['email'])->take(1)->get();
        //  dd($already_found_email);
         if(User::where('email',$validated['email'])->exists()){
            return response()->json(['message'=>'email already exist in database'])->setStatusCode(400);
         }
         $name = $validated['name'];
         $email= $validated['email'];
         $password= bcrypt($validated['password']);
         $user = new User();
         $user->name=$name;
         $user->email = $email;
         $user->password = $password;
         $user->save();
        //  Auth::login($user,true);
        //  $token = request()->user()->createToken('beans')->plainTextToken;
        $token = $user->createToken('beans')->plainTextToken;
        $user->load(['Carts.Product.Images','Orders.Product.Images']);
        $orders = $user->Orders;
        $cart = $user->Carts;
        $user = ['name'=>$user->name,
                'email'=>$user->email,
                "isadmin"=>$user->isadmin,
                'token'=>$token
                ];
         return response()->json(compact('user','cart','orders'));
       

   
}
public function signin(){
    $rules=[
        'email'=>'required|email',
        'password'=>'required|min:6'
    ];
    $message=[
        'required'=>'the :attribute field is required',
        'email'=>'the :attribute must be a valid email',
        'min'=>'the :attribute must be a minimum of 6 words'
    ];
    $validator = Validator::make(request()->all(),$rules,$message);

    if($validator->fails()){
        return response()->json($validator->errors())->setStatusCode(400);
    }
    $validated = $validator->validated();
    $email= $validated['email'];
    $password= $validated['password'];
    if(!Auth::attempt(compact('email','password'))){
           return response()->json(['message'=>'sorry credentials not correct']);
    }
    $user = User::where(compact('email'))->first();
    $token = $user->createToken('beans')->plainTextToken;
    $user->load(['Carts.Product.Images','Orders.Product.Images']);
    $orders = $user->Orders;
    $cart = $user->Carts;
     $user = ['name'=>$user->name,
                'email'=>$user->email,
                "isadmin"=>$user->isadmin,
                'token'=>$token
                ];
         return response()->json(compact('user','cart','orders'));

}


public function logout(){
//    return response()->json(['message'=>' are sure u want to log out']);

  request()->user()->tokens()->where('tokenable_id',request()->user()->id)->delete();
  return response()->json(['message'=>'ok']);
}

public function AccountSettings(){
    $rules=[
        'name'=>'required|min:3|max:25',
        'email'=>'required|email'
    ];
    $message=[
        'required'=>'the :attribute field is required',
        'email'=>'the :attribute must be a valid email',
        'min'=>'the :attribute must be a minimum of 6 words'
    ];
    $validator = Validator::make(request()->all(),$rules,$message);

    if($validator->fails()){
        return response()->json($validator->errors())->setStatusCode(400);
    }
    $user = request()->user();
    $user->name = request()->input('name');
    $user->email = request()->input('email');
    $user->save();
    return response()->json(compact('user'));
}

}
