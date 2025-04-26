<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // نمایش همه تاپیک‌ها
    public function index()
    {
        $topics = Topic::with('user', 'tags')->latest()->get();
        return view('forum.index', compact('topics'));
    }

    // فرم ساخت تاپیک جدید
    public function create()
    {
        return view('forum.create');
    }

    // ذخیره تاپیک جدید
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'tags' => 'nullable|string',
        ]);

        $topic = Topic::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if ($request->tags) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $topic->tags()->attach($tag->id);
            }
        }

        return redirect()->route('forum.index');
    }

    // نمایش یک تاپیک به همراه پست‌ها
    public function show(Topic $topic)
    {
        $posts = Post::where('topic_id', $topic->id)->whereNull('parent_id')->with('children')->get();
        return view('forum.show', compact('topic', 'posts'));
    }

    // پاسخ به یک تاپیک یا پست
    public function reply(Request $request, Topic $topic)
    {
        $request->validate([
            'body' => 'required',
            'parent_id' => 'nullable|exists:posts,id',
        ]);

        Post::create([
            'topic_id' => $topic->id,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'body' => $request->body,
        ]);

        return back();
    }
}
