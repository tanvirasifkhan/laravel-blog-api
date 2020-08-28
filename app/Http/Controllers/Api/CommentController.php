<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use Response;
use Validator;
use Auth;

class CommentController extends Controller {
    // show comments
    public function index(){
        return CommentResource::collection(Comment::orderBy('id','DESC')->paginate(10));
    }
}
