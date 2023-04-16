<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(1);
        return view('blog.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        return view('blog.show', ['blog' => $blog]);
    }

    public function store(Request $request)
    {
        Blog::create($request->all());
        return redirect('/blog');
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('/blog');
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->update($request->all());

        return redirect('/blog');
    }

    public function create()
    {
        return view('blog.create');
    }
}
