<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('permission:manage posts')->only(['store', 'update', 'destroy']);
    }


    public function index(Request $request)
    {
        
        $page    = (int) $request->input('page', 1);
        $perPage = (int) $request->input('perPage', 10);

        
        $query = Post::with(['category', 'user']);

        
        $posts = $query->paginate($perPage, ['*'], 'page', $page);

        
        if ($page > $posts->lastPage()) {
            return response()->json([
                'data'         => [],
                'current_page' => $page,
                'hasMore'      => false,
                'message'      => 'No additional data available.',
            ], 200);
        }

       
        return response()->json([
            'data'         => $posts->items(),
            'current_page' => $posts->currentPage(),
            'hasMore'      => $posts->currentPage() < $posts->lastPage(),
        ], 200);
    }



    public function show($id)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Unauthenticated. Please log in to access this resource.'
            ], 401);
        }

        try {
            $post = Post::with('category', 'user')->findOrFail($id);
            return response()->json($post);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    public function store(StorePostRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['title']);
            $data['user_id'] = auth()->id();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('posts', 'public');
            }

            $post = Post::create($data);

            return response()->json(['message' => 'Post created', 'post' => $post], 201);
        } catch (UnauthorizedException | AuthorizationException $e) {
            return response()->json(['message' => 'User does not have the right permissions.'], 403);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);

            $request->merge([
                'title'        => $request->input('title'),
                'category_id'  => $request->input('category_id'),
                'description'  => $request->input('description'),
                'body'         => $request->input('body'),
                'is_published' => $request->input('is_published'),
            ]);

            $data = $request->validate([
                'title'        => 'required|string|max:255',
                'category_id'  => 'required|exists:categories,id',
                'description'  => 'required|string',
                'body'         => 'nullable|string',
                'is_published' => 'nullable|boolean',
                'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);

            $slug = Str::slug($data['title']);
            $originalSlug = $slug;
            $counter = 1;

            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
            $data['slug'] = $slug;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('posts', 'public');
                $data['image'] = 'storage/' . $path;
            }

            $post->update(array_filter($data));

            return response()->json([
                'message' => 'Post updated successfully',
                'post'    => $post,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (UnauthorizedException | AuthorizationException $e) {
            return response()->json(['message' => 'User does not have the right permissions.'], 403);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (UnauthorizedException | AuthorizationException $e) {
            return response()->json(['message' => 'User does not have the right permissions.'], 403);
        }
    }
}
