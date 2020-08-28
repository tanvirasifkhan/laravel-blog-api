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

    // store new comment into the database
    public function store(Request $request){
        $validators=Validator::make($request->all(),[
            'comment'=>'required',
            'article'=>'required'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $comment=new Comment();
            $comment->comment=$request->comment;
            $comment->author_id=$request->author;
            $comment->article_id=$request->article;
            $comment->save();
            return Response::json(['success'=>'Comment created successfully !']);
        }
    }

    // show a specific comment
    public function show($id){
        if(Comment::where('id',$id)->first()){
            return new CommentResource(Comment::findOrFail($id));
        }else{
            return Response::json(['error'=>'Comment not found!']);
        }        
    }
}
