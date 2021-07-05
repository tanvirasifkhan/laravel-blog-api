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
        return CommentResource::collection(Comment::where('author_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10));
    }

    // check comment validation
    public function checkComment(Request $request){
        $validators = Validator::make($request->all(),[
            'comment'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }

    // check article validation
    public function checkArticle(Request $request){
        $validators = Validator::make($request->all(),[
            'article'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
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
            $comment->author_id=Auth::user()->id;
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

    // update comment into the database
    public function update(Request $request){
        $validators=Validator::make($request->all(),[
            'comment'=>'required',
            'article'=>'required'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $comment=Comment::where('id',$request->id)->where('author_id',Auth::user()->id)->first();
            if($comment){
                $comment->comment=$request->comment;
                $comment->author_id=Auth::user()->id;
                $comment->article_id=$request->article;
                $comment->save();
                return Response::json(['success'=>'Comment updated successfully !']);
            }else{
                return Response::json(['error'=>'Comment not found !']);
            }            
        }
    }

    // remove article
    public function remove(Request $request){
        try{
            $comment=Comment::where('id',$request->id)->where('author_id',Auth::user()->id)->first();
            if($comment){
                $comment->delete();
                return Response::json(['success'=>'Comment removed successfully !']);
            }else{
                return Response::json(['error'=>'Comment not found!']);
            }
        }catch(\Illuminate\Database\QueryException $exception){
            return Response::json(['error'=>'Comment belongs to author/article.So you cann\'t delete this comment!']);
        }        
    }
}
