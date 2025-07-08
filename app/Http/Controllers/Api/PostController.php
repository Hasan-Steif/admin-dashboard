<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        try {
            $search  = $request->query('search');
            $page    = (int) $request->query('page', 1);
            $perPage = (int) $request->query('per_page', 10);

            $query = Post::with(['category', 'user']);

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title',       'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('body',       'like', "%{$search}%");
                });
            }

            $posts = $query->paginate($perPage, ['*'], 'page', $page);

            if ($posts->total() === 0) {
                return $this->errorResponse('No posts found', [], 404);
            }

            return $this->paginateResponse($posts);
        } catch (\Exception $e) {
            return $this->errorResponse('Error fetching posts: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $post = Post::with(['category', 'user'])->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data'   => $post,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Post not found', [], 404);
        }
    }

    public function store(StorePostRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug']    = Str::slug($data['title']);
            $data['user_id'] = $request->user()->id;

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('posts', 'public');
            }

            $post = Post::create($data);

            return response()->json([
                'status'  => 'success',
                'message' => 'Post created successfully',
                'data'    => $post,
            ], 201);
        } catch (AuthorizationException | UnauthorizedException $e) {
            return $this->errorResponse('User does not have the right permissions.', [], 403);
        } catch (ValidationException $e) {
            return $this->errorResponse('Validation failed', $e->errors(), 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);

            if ($request->isMethod('put') || $request->isMethod('patch')) {
                $request->merge([
                    'title'        => $request->input('title'),
                    'category_id'  => $request->input('category_id'),
                    'description'  => $request->input('description'),
                    'body'         => $request->input('body'),
                    'is_published' => $request->input('is_published'),
                ]);
            }

            $data = $request->validate([
                'title'        => 'sometimes|required|string|max:255',
                'category_id'  => 'sometimes|required|exists:categories,id',
                'description'  => 'sometimes|string',
                'body'         => 'sometimes|string',
                'is_published' => 'sometimes|boolean',
                'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);

            if (isset($data['title'])) {
                $originalSlug = Str::slug($data['title']);
                $slug = $originalSlug;
                $counter = 1;
                while (Post::where('slug', $slug)->where('id', '<>', $post->id)->exists()) {
                    $slug = "{$originalSlug}-{$counter}";
                    $counter++;
                }
                $data['slug'] = $slug;
            }

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('posts', 'public');
                $data['image'] = asset('storage/' . $path);
            }

            $post->update(array_filter($data));

            return response()->json([
                'status'  => 'success',
                'message' => 'Post updated successfully',
                'data'    => $post,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Post not found', [], 404);
        } catch (AuthorizationException | UnauthorizedException $e) {
            return $this->errorResponse('User does not have the right permissions.', [], 403);
        } catch (ValidationException $e) {
            return $this->errorResponse('Validation failed', $e->errors(), 422);
        }
    }


    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return response()->json([
                'status'  => 'success',
                'message' => 'Post deleted successfully',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Post not found', [], 404);
        } catch (AuthorizationException | UnauthorizedException $e) {
            return $this->errorResponse('User does not have the right permissions.', [], 403);
        }
    }
}
