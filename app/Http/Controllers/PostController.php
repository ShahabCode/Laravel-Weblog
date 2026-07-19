<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category']);

        if (!(auth()->check() && auth()->user()->is_admin)) {
            $query->published();
        }

        $posts = $query
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->search($request->input('q'));
            })
            ->orderBy('published_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('posts.index', [
            'posts' => $posts,
            'searchTerm' => $request->input('q'),
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|unique:posts,slug',
            'content'      => 'required|string',
            'category_id'  => 'nullable|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'title'        => $validated['title'],
            'slug'         => $validated['slug'],
            'content'      => $validated['content'],
            'category_id'  => $validated['category_id'] ?? null,
            'image'        => $validated['image'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'user_id'      => auth()->id(),
//            'view_count'   => 0,
            'is_published' => false,
        ]);

        return redirect()->route('posts.my_posts')->with('success', 'پست با موفقیت ثبت شد');
    }

    public function show(Post $post)
    {
        $user = auth()->user();

        if (!$post->is_published) {

            if (
                !$user ||
                ($user->id != $post->user_id && !$user->is_admin)
            ) {
                abort(404);
            }
        }

        $post->incrementViewCount();

        return view('posts.show', compact('post'));
    }
    public function edit(Post $post)
    {
        $user = auth()->user();

        if (!($user && ($user->id == $post->user_id || $user->is_admin))) {
            abort(403, 'فقط نویسنده و ادمین میتوانند ویرایش کنند');
        }

        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $user = auth()->user();

        if (!($user && ($user->id == $post->user_id || $user->is_admin))) {
            abort(403, 'فقط نویسنده و ادمین میتوانند بروزرسانی کنند');
        }

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|unique:posts,slug,' . $post->id,
            'content'      => 'required|string',
            'category_id'  => 'nullable|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                \Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->fill($validated);

        if (!$user->is_admin) {
            $post->is_published = false;
        }

        $post->save();

        if ($user->is_admin) {
            return redirect()->route('posts.show', $post)->with('success', 'پست با موفقیت ویرایش شد');
        }

        return redirect()->route('posts.my_posts')->with('warning', 'پست ویرایش شد و نیاز به تایید ادمین دارد');
    }

    public function approve(Post $post)
    {
        abort_unless(auth()->user()?->is_admin, 403, 'فقط ادمین می‌تواند پست را تایید کند');

        $post->is_published = true;
        $post->save();

        return back()->with('success', 'پست تایید و منتشر شد');
    }

    public function destroy(Post $post)
    {
        $user = auth()->user();

        if (!($user && ($user->id == $post->user_id || $user->is_admin))) {
            abort(403, 'فقط نویسنده و ادمین میتوانند حذف کنند');
        }

        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'پست با موفقیت حذف شد');
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->id())
            ->with('category')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('posts.my_posts', compact('posts'));
    }
}
