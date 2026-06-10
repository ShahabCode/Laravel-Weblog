<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->orderBy('published_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|unique:posts,slug',
            'content'      => 'required|string',
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
            'image'        => $validated['image'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'user_id'      => auth()->id(),
//            'view_count'   => 0,
            'is_published' => false,
        ]);

        return redirect()->route('posts.my_posts')->with('success', 'مقاله با موفقیت ثبت شد');
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

        return view('posts.edit', compact('post'));
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
            return redirect()->route('posts.show', $post)->with('success', 'مقاله با موفقیت ویرایش شد');
        }

        return redirect()->route('posts.my_posts')->with('warning', 'مقاله ویرایش شد و نیاز به تایید ادمین دارد');
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
        return redirect()->route('posts.index')->with('success', 'مقاله با موفقیت حذف شد');
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->id())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('posts.my_posts', compact('posts'));
    }
}
