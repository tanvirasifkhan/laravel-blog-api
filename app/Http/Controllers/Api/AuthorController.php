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
}
