<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $allowedSorts = ['created_at','name','is_read'];
        $sort = $request->query('sort');
        $sort = in_array($sort, $allowedSorts, true) ? $sort : 'created_at';

        $messages = ContactMessage::orderBy($sort, 'desc')->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success','Pesan dihapus.');
    }

    public function markRead(ContactMessage $message)
    {
        $message->update(['is_read' => true, 'replied_at' => now()]);
        return back()->with('success','Ditandai sudah dibalas.');
    }
}
