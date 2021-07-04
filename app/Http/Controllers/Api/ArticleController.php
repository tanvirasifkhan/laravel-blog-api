<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CommentResource;
use Illuminate\Validation\Rule;
use App\Models\Article;
use App\Models\Comment;
use Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller {
    // show all the article
    public function index(){
        return ArticleResource::collection(Article::where('author_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10));
    }

    // check title validation
    public function checkTitle(Request $request){
        $validators = Validator::make($request->all(),[
            'title'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }

    // check category validation
    public function checkCategory(Request $request){
        $validators = Validator::make($request->all(),[
            'category'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }

    // check body validation
    public function checkBody(Request $request){
        $validators = Validator::make($request->all(),[
            'body'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }

    // store new article into the database
    public function store(Request $request){
        $validators=Validator::make($request->all(),[
            'title'=>'required',
            'category'=>'required',
            'body'=>'required'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $article=new Article();
            $article->title=$request->title;
            $article->author_id=Auth::user()->id;
            $article->category_id=$request->category;
            $article->body=$request->body;
            if($request->file('image')==NULL){
                $article->image='placeholder.png';
            }else{
                $filename=Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();
                $article->image=$filename;
                $request->image->move(public_path('images'),$filename);
            }
            $article->save();
            return Response::json(['success'=>'Article created successfully !']);
        }
    }

    // show a specific article by id
    public function show($id){        
        if(Article::where('id',$id)->first()){
            return new ArticleResource(Article::findOrFail($id));
        }else{
            return Response::json(['error'=>'Article not found!']);
        }
    }

    // update article using id
    public function update(Request $request){
        $validators=Validator::make($request->all(),[
            'title'=>'required',
            'category'=>'required',
            'body'=>'required'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $article=Article::where('id',$request->id)->where('author_id',Auth::user()->id)->first();
            if($article){
                $article->title=$request->title;
                $article->author_id=Auth::user()->id;
                $article->category_id=$request->category;
                $article->body=$request->body;
                if($request->file('image')==NULL){
                    $article->image='placeholder.png';
                }else{
                    $filename=Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();
                    $article->image=$filename;
                    $request->image->move(public_path('images'),$filename);
                }
                $article->save();
                return Response::json(['success'=>'Article updated successfully !']);
            }else{
                return Response::json(['error'=>'Article not found !']);
            }            
        }
    }

    // remove article using id
    public function remove(Request $request){
        try{
            $article=Article::where('id',$request->id)->where('author_id',Auth::user()->id)->first();
            if($article){
                $article->delete();
                return Response::json(['success'=>'Article removed successfully !']);
            }else{
                return Response::json(['error'=>'Article not found!']);
            }
        }catch(\Illuminate\Database\QueryException $exception){
            return Response::json(['error'=>'Article belongs to comment.So you cann\'t delete this article!']);
        }        
    }

    // search article by keyword
    public function searchArticle(Request $request){
        $articles=Article::where('title','LIKE','%'.$request->keyword.'%')->get();
        if(count($articles)==0){
            return Response::json(['message'=>'No article match found !']);
        }else{
            return Response::json($articles);
        }        
    }

    // fetch comments for a specific article
    public function comments($id){
        if(Article::where('id',$id)->first()){
            return CommentResource::collection(Comment::where('article_id',$id)->get());
        }else{
            return Response::json(['error'=>'Article not found!']);
        }
    }
}
