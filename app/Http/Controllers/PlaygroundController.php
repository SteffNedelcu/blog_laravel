<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\DB;


class PlaygroundController extends Controller
{
    // afisez toate posturile
    public function index(Request $request)
    {
        $posts = Post::all();
        return $posts;
    }
    // afisez un singur post - /pg/posts/1   - varianta 1
    public function find(Post $post)
    {
        return $post;
    }
     // afisez un singur post - /pg/posts/1   - varianta 2
    public function find2($id)
    {
        // dd($id);
        return  Post::find($id);
    }
     // afisez post-urile cu anumite id-uri - /pg/posts-in   - varianta 1
    public function getIn(Request $request)
    {
        // dd($request);
        return  Post::find([1,2]);
    }
    // afisez post-urile cu anumite id-uri - /pg/posts-in   - varianta 2
    public function getIn2(Request $request)
    {
        $postModel = new Post();
        $postModel =    $postModel->whereIn('id',[1,3])->where('category_id',1);

        return $postModel->get();
    }
    // cat toate post-urile intre anumite dati
    public function whereBetween(Request $request)
    {
        return  Post::whereBetween('created_at', ['2019-04-01', '2019-04-30'])->get();
    }

    // TODO
    public function whereActive(Request $request)
    {
        return  Banner::where('start_date', "<", date("Y-m-d H:i:s"))->where('end_date', ">", date("Y-m-d H:i:s"))->get();
    }
    // find last post
    public function lastPost(Request $request)
    {
        return  Post::latest()->first();
    }
     // random
     public function randomPost(Request $request)
     {
        //  return  Post::inRandomOrder()->first();
         //SAU daca vreau sa ii pun o limita
         return  Post::inRandomOrder()->limit(2)->get();
     }
     public function mapceva(Request $request){
        return  Post::all()->map(function ($post) {
            return $post->title;
        });

        //SAU 
        return  Post::inRandomOrder()->limit(2)->get()->map(function ($post) {
            return $post->title;
        });
     }
     // #########  USER  ############

     // auth()->id() - returneaza id-ul
     // auth()->user() - returneaza instanta cu utilizatorul
     // auth()->check() - returneaza instanta adevarat/fals daca e logat sau nu
     // auth()->guest() - returneaza instanta adevarat/fals daca e oaspete (nu e logat) sau nu

     // Access user informations
     public function getUser(){
        //  dd(auth()->user());
        return [
            'user_id'=>auth()->id(),
            'name'=>auth()->user()->name,
            'email'=>auth()->user()->email,
            'remember_token'=>auth()->user()->remember_token
        ];
     }
     // Post-urile unui utilizator
     public function getUserPosts(){
        return  Post::where('user_id',auth()->id())->get();
     }

     // ############################

     // ########## JOINS  ###############
     // Post-urile unui utilizator
     public function leftJoin(){
        return  DB::table('posts')->select('posts.*', 'categories.title as category_title', 'users.email')  
                  ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
                ->get();

     }
     // ########################


     // #######   Paginations   ###########

     // url http://127.0.0.1:8000/pg/testPagination?page=2
     // citeste el singur ?page=x
     public function testPagination(Request $request){
        // ::paginate(x) unde X e perPage
        return  Post::paginate(2);
     }

}
