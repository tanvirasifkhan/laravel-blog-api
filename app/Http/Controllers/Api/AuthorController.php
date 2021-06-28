<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Models\User;
use Response;
use Validator;
use Illuminate\Support\Str;
use Auth;

class AuthorController extends Controller {
    // show all the users
    public function index(){
        return AuthorResource::collection(User::orderBy('id','DESC')->paginate(10));
    }

    // check name validation
    public function checkName(Request $request){
        $validators=Validator::make($request->all(),[
            'name'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }

    // register user
    public function register(Request $request){
        $validators=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $author=new User();
            $author->name=$request->name;
            $author->email=$request->email;
            $author->password=bcrypt($request->password);
            $author->api_token=Str::random(80);
            $author->save();
            return Response::json(['success'=>'Registration done successfully !','author'=>$author,'token'=>$author->api_token]);
        }
    }

    // login user
    public function login(Request $request){
        $validators=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                $author=$request->user();
                $author->api_token=Str::random(80);
                $author->save();
                return Response::json(['success'=>'Login was successfully !','author'=>Auth::user(),'token'=>Auth::user()->api_token]);
            }else{
                return Response::json(['errors'=>'Login failed ! Wrong credentials.']);
            }
        }
    }

    // log the author out
    public function logout(Request $request){
        $author=$request->user();
        $author->api_token=NULL;
        $author->save();
        return Response::json(['message'=>'Logged out!']);
    }
}
