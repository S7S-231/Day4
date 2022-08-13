<?php

namespace App\Http\Controllers;
//use Auth;

use App\Models\post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPost;
//use App\Models\User;
use Illuminate\Validation\ValidationException;

class Postcontroller extends Controller
{
    //
    public function index()
    {
        $posts = post::simplePaginate(14);



        return view('posts.index')->with(["posts" => $posts  ]);
    }
    public function create()
    {

        return view('posts.create');
    }
    public function store(StoreBlogPost $req)
    {



        $name = $req->input('name');
        $email = $req->input('body');
        $pass = $req->input('r1');

        $req->validated();
        
        if( $req->hasFile('image') ){
            $path = $req->file('image')->store('images','public');
            post::create(
                ['title' => $name , 'body' => $email , 'enabled' => $pass ,'user_id' => auth()->user()->id , 'image' => $path ]);
        }
        else{
        post::create(
        ['title' => $name , 'body' => $email , 'enabled' => $pass ,'user_id' => auth()->user()->id  ]);
        }
        return redirect()->Route("posts.index");
    }






    public function show($id)
    {

        $post = post::where('P_id', $id)->get()->first();
        return view('posts.show',['post'=>$post]);
    }



       //
       public function edit($id)
       {
            $post = post::where('P_id', $id)->get()->first();



            if($post->user_id == auth()->id()){

                return view('posts.edit')->with( [ "post" => $post  ]);
        }
        else {
            return redirect()->Route("posts.index");
        }

    }

       public function update(Request $req , $id)
       {

        $name = $req->input('name');
        $email = $req->input('body');
        $pass = $req->input('r1');

            $req->validate([
            'name' => ' required|max:100',
            'body' => 'required|max:1000',
            ]);


            post::where('P_id', $id)->update(['title'=> $name , 'body'=> $email , 'enabled' => $pass]);

            return redirect()->Route("posts.index");
    }
       public function destroy($id)
       {
        post::where('P_id', $id)->delete();

        return redirect()->Route("posts.index");



    }

    public function dlist()
    {
        $users = post::onlyTrashed()->simplePaginate(15);


        return view('posts.deleted')->with(["users" => $users]);
    }

    public function restore($id){


        post::onlyTrashed()->where('P_id', $id)->restore();


        return redirect()->route('posts.dlist');

    }


}
