<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category'])->latest()->paginate(10);
        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blog.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'title'         => 'required|string|max:255',
                'category_id'   => 'required|exists:categories,id',
                'description'   => 'required|string',
                'body'          => 'nullable|string',
                'image'         => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:10240',
                'is_published'  => 'required|boolean',
            ]);

            $data['user_id']    = auth()->id();
            $data['slug']       = Str::slug($data['title']);
            // ensure boolean
            $data['is_published'] = $request->boolean('is_published');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('posts', 'public');
            }

            Post::create($data);

            return redirect()->route('admin.posts.index')
                             ->with('success', 'Post created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.blog.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        try {
            $data = $request->validate([
                'title'         => 'required|string|max:255',
                'category_id'   => 'required|exists:categories,id',
                'description'   => 'required|string',
                'body'          => 'nullable|string',
                'image'         => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:10240',
                'is_published'  => 'required|boolean',
            ]);

            $data['slug']         = Str::slug($data['title']);
            $data['is_published'] = $request->boolean('is_published');

            if ($request->hasFile('image')) {
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }
                $data['image'] = $request->file('image')->store('posts', 'public');
            }

            $post->update($data);

            return redirect()->route('admin.posts.index')
                             ->with('success', 'Post updated successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Post deleted successfully.');
    }
}

