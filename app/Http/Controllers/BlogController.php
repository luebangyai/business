<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Content;

class BlogController extends Controller
{
    public function index(Request $request) {
        $data['blogs'] = Content::where('type', 'blog')->orderBy('sort', 'asc')->get();
        return view('blogs')->with($data);
    }

    public function show($id) {
        if(isset($id) && !empty($id)){
           $token = explode("-", $id);
           if(!empty($token[2])){
            $ref1 = $token[0] / 789;
            $ref2 = $token[1] / 897;
            if($ref1 == $ref2){
                $check = Content::where('id', $ref1)->count();
                if($check > 0){
                    $data['blog'] = Content::where('id', $ref1)->first();
                    return view('show')->with($data);
                }
            }
           }
        }

        return redirect('/blogs');
    }
}
