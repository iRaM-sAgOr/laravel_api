<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Article;
use DB;
use Post;
//use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Ger articles
        $query="SELECT `id`, `title`, `body` FROM `articles` where id<=10";
        $users= DB::select($query);
        return json_encode($users);
        // $articles = Article::paginate(1);
        // return response()->json (
        //     $articles
        // );
       
        //Return collection of articles as a resource
        //return ArticleResource::collection($articles);
        //return 'sagor';

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        //    $post= new Post;
        //    $post->all = $request->all();
        //    $post->save();
        $title = Request::get('title');
        $body =  Request::get('body');
        $query="INSERT INTO `articles`(title, body) VALUES ('$title','$body')";
        \DB::insert(\DB::raw($query));
        // return redirect('view_client');
        //DB::select($query);
        // $title = Request::get('title');
        // $body =  Request::get('body');
        // return $title;
        // return Article::create($request->all());
         
        // $client_insert_query = "INSERT INTO phoenix_tt_db.client_table (client_name,priority,kam_name,email,phone,client_type)
        //  VALUES ('$client_name','$client_priority','$kam','$email','$phone','$client_type')";


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
