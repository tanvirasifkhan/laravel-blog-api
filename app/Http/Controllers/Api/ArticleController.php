<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Http\Resources\ArticleResource;
use Illuminate\Validation\Rule;
use App\Models\Article;
use Auth;

class ArticleController extends Controller {
    // show all the article
    public function index(){
        return ArticleResource::collection(Article::orderBy('id','DESC')->paginate(10));
    }
}
