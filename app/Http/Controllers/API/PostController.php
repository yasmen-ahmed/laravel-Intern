<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

use App\Http\Requests\CreatePostRequest;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Post::with('category')
        ->get();

        return response()->json($results);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
       $post->category()->sync( 
        $request->input('categories')
       );

        return response()->json($post,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePostRequest $request,  $id)
    {
        $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->content = $request->input('content');
            $post->save();
            $post->category()->sync( 
                $request->input('categories')
               );

            return response()->json($post);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {   
        $post = Post::find($id);
        if($post){
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully']);
        

        }
        else {
            return response()->json(['message' =>"this post not found"]);
        }
     }

    public function search(Request $request){
        $query = $request->input('q');
        $posts = Post::where('title', 'LIKE', "%$query%")
                     ->orWhere('content', 'LIKE', "%$query%")
                     ->get();
        return response()->json($posts);
    }
    
}
