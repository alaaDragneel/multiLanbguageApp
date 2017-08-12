<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(8);

        return view('home', compact('posts'));
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->title = serialize($request->title);
        $post->body = serialize($request->body);
        $post->image = $this->uplaod($request->file('image'));
        $check = $post->save();
        if ($check) {
            return back()->with('success', 'Post Added Successfully');
        } else {
            return back()->with('error', 'Faield To Add Post');
        }

    }

    protected function uplaod($file)
    {
        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        $fileName = date("y-m-d-h-i-s") . "_" . $sha1 . "." .$extension;
        $path = public_path('images/');
        $file->move($path, $fileName);

        return 'images/' . $fileName;
    }
}
