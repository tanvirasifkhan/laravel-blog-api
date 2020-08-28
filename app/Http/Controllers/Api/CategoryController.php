<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Http\Resources\CategoryResource;
use Illuminate\Validation\Rule;
use App\Models\Category;

class CategoryController extends Controller {
    // show all the categories
    public function index(){
        return CategoryResource::collection(Category::orderBy('id','DESC')->paginate(10));
    }

    // store new category into the database
    public function store(Request $request){
        $validators=Validator::make($request->all(),[
            'title'=>'required|unique:categories',
            'slug'=>'required|unique:categories'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $category=new Category();
            $category->title=$request->title;
            $category->slug=strtolower(implode('-',explode(' ',$request->slug)));
            $category->save();
            return Response::json(['success'=>'Category created successfully !']);
        }
    }
}