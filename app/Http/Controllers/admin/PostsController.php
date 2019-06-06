<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = [];
        $where = [];
        $postModel = new Post();

        //verific ce capuri gasesc in url (GET request)
        /*
        if ($request->has('title')) {
            $title = $request->query('title');
            $search['title'] =  $title;

            //adaug cautarea intr-un array
            $where[] = ['title', 'LIKE', "%$title%"];
        }
        if ($request->has('category')) {
            $category = $request->query('category');
            $search['category'] =  $category;
            $where[] = ['category_id', '=', $category];
        }
        // daca am elemente in array-ul de cautare
        if(!empty($where)){         
            $posts = $postModel->where($where)->get();
        }else{
            $posts = $postModel->all(); // fallback le scot pe toate
        }
        */
        // SAU - mai usor

        if ($request->has('title')) {
            $title = $request->query('title');
            $search['title'] =  $title;
            $postModel = $postModel->where('title', 'LIKE', "%$title%");
        }
        if ($request->has('category')) {
            $category = $request->query('category');
            $search['category'] =  $category;
            $postModel = $postModel->where('category_id', '=', $category);
        }

        $posts =  $postModel->get();
        return view('admin.posts.index' , ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('admin.posts.create', ['category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category)
    {
        // dd(request()->all());
        //validations
        request()->validate([
            'title' => ['required','min:5','max:255'],
            'description' => ['required','min:5'],
            'content' => ['required','min:5'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        /**
         * Image upload
         * https://hdtuto.com/article/laravel-57-image-upload-with-validation-example
         */

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        //create post
        Post::create([
            'title' => request('title'),
            'description' => request('description'),
            'content' => request('content'),
            'category_id' => $category->id,
            'user_id' => 1,
            'poza' => $imageName
            ]);
        return redirect('admin/categories/'.$category->id);
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
        return view('admin.posts.edit',['post'=>Post::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validations
        request()->validate([
            'title' => ['required','min:5','max:255'],
            'description' => ['required','min:5'],
            'content' => ['required','min:5']

        ]);

        /**
         * Image upload
         * https://hdtuto.com/article/laravel-57-image-upload-with-validation-example
         */
        if(request()->image){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            $post->poza =  $imageName;
        }
        

        $post->title =  request('title');
        $post->description =  request('description');
        $post->content =  request('content');

        $post->save();
        return redirect('admin/categories/'. $post->category_id);
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
