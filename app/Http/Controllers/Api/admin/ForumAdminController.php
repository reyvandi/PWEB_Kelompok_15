<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use App\Models\ForumTopic;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin'); // Middleware untuk memastikan hanya admin
    }

    // Dashboard admin forum
    public function index()
    {
        $stats = [
            'total_categories' => ForumCategory::count(),
            'total_topics' => ForumTopic::count(),
            'total_replies' => ForumReply::count(),
            'pending_replies' => ForumReply::where('is_approved', false)->count(),
        ];

        $recentTopics = ForumTopic::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.forum.index', compact('stats', 'recentTopics'));
    }

    // Kelola kategori
    public function categories()
    {
        $categories = ForumCategory::orderBy('sort_order')->get();
        return view('admin.forum.categories', compact('categories'));
    }

    // Kelola topik
    public function topics()
    {
        $topics = ForumTopic::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.forum.topics', compact('topics'));
    }

    // Pin/Unpin topik
    public function togglePin(ForumTopic $topic)
    {
        $topic->update(['is_pinned' => !$topic->is_pinned]);

        $status = $topic->is_pinned ? 'disematkan' : 'tidak disematkan';
        return back()->with('success', "Topik berhasil {$status}!");
    }

    // Lock/Unlock topik
    public function toggleLock(ForumTopic $topic)
    {
        $topic->update(['is_locked' => !$topic->is_locked]);

        $status = $topic->is_locked ? 'dikunci' : 'dibuka kembali';
        return back()->with('success', "Topik berhasil {$status}!");
    }

    // Hapus topik (admin)
    public function deleteTopic(ForumTopic $topic)
    {
        $topic->delete();
        return back()->with('success', 'Topik berhasil dihapus!');
    }

    // Kelola replies
    public function replies()
    {
        $replies = ForumReply::with(['user', 'topic'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.forum.replies', compact('replies'));
    }

    // Approve/Disapprove reply
    public function toggleApproval(ForumReply $reply)
    {
        $reply->update(['is_approved' => !$reply->is_approved]);

        $status = $reply->is_approved ? 'disetujui' : 'tidak disetujui';
        return back()->with('success', "Balasan berhasil {$status}!");
    }
}
