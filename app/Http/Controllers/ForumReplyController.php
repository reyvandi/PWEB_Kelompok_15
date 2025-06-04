<?php

namespace App\Http\Controllers;

use App\Models\ForumTopic;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    // Menyimpan reply baru
    public function store(Request $request, ForumTopic $topic)
    {
        if ($topic->is_locked) {
            return back()->with('error', 'Topik ini telah dikunci dan tidak dapat dibalas.');
        }

        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:forum_replies,id'
        ]);

        ForumReply::create([
            'content' => $request->content,
            'topic_id' => $topic->id,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }

    // Edit reply (hanya pembuat)
    public function edit(ForumReply $reply)
    {
        if ($reply->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit balasan ini.');
        }

        return view('forum.reply-edit', compact('reply'));
    }

    // Update reply
    public function update(Request $request, ForumReply $reply)
    {
        if ($reply->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit balasan ini.');
        }

        $request->validate([
            'content' => 'required|string'
        ]);

        $reply->update([
            'content' => $request->content
        ]);

        return redirect()->route('forum.show', $reply->topic->slug)
            ->with('success', 'Balasan berhasil diperbarui!');
    }

    // Hapus reply (hanya pembuat)
    public function destroy(ForumReply $reply)
    {
        if ($reply->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus balasan ini.');
        }

        $topicSlug = $reply->topic->slug;
        $reply->delete();

        return redirect()->route('forum.show', $topicSlug)
            ->with('success', 'Balasan berhasil dihapus!');
    }
}
