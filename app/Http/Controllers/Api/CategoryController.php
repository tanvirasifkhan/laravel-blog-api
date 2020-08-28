<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Resources\CategoryResource;
use Illuminate\Validation\Rule;

class CategoryController extends Controller {
    // show all the categories
    public function index(){
        return CategoryResource::collection(Category::orderBy('id','DESC')->paginate(10));
    }
}