<?php

namespace App\Http\Controllers;

use App\Models\ForumCategory;
use App\Models\ForumTopic;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user'); // Middleware untuk memastikan hanya user
    }

    // Menampilkan halaman utama forum
    public function index()
    {
        $categories = ForumCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->withCount(['topics', 'activeTopics'])
            ->get();

        $recentTopics = ForumTopic::with(['user', 'category', 'lastReplyUser'])
            ->orderBy('last_activity_at', 'desc')
            ->take(5)
            ->get();

        return view('forum.index', compact('categories', 'recentTopics'));
    }

    // Menampilkan topik dalam kategori
    public function category(ForumCategory $category)
    {
        $topics = ForumTopic::where('category_id', $category->id)
            ->with(['user', 'lastReplyUser'])
            ->orderBy('is_pinned', 'desc')
            ->orderBy('last_activity_at', 'desc')
            ->paginate(15);

        return view('forum.category', compact('category', 'topics'));
    }

    // Menampilkan detail topik dan replies
    public function show(ForumTopic $topic)
    {
        // Increment views
        $topic->incrementViews();

        $topic->load(['user', 'category']);

        $replies = ForumReply::where('topic_id', $topic->id)
            ->where('is_approved', true)
            ->with(['user', 'likes'])
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('forum.show', compact('topic', 'replies'));
    }

    // Form membuat topik baru
    public function create(Request $request)
    {
        $categories = ForumCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $selectedCategory = $request->get('category');

        return view('forum.create', compact('categories', 'selectedCategory'));
    }

    // Menyimpan topik baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:forum_categories,id'
        ]);

        $topic = ForumTopic::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forum.show', $topic->slug)
            ->with('success', 'Topik berhasil dibuat!');
    }

    // Form edit topik (hanya pembuat)
    public function edit(ForumTopic $topic)
    {
        if ($topic->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit topik ini.');
        }

        $categories = ForumCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('forum.edit', compact('topic', 'categories'));
    }

    // Update topik
    public function update(Request $request, ForumTopic $topic)
    {
        if ($topic->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit topik ini.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:forum_categories,id'
        ]);

        $topic->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('forum.show', $topic->slug)
            ->with('success', 'Topik berhasil diperbarui!');
    }

    // Hapus topik (hanya pembuat)
    public function destroy(ForumTopic $topic)
    {
        if ($topic->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus topik ini.');
        }

        $categoryId = $topic->category_id;
        $topic->delete();

        return redirect()->route('forum.category', $categoryId)
            ->with('success', 'Topik berhasil dihapus!');
    }
}
