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
}