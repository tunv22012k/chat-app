<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::with(['user'])->where('room_id', (int) $request->query('room_id'))->orderBy('created_at', 'asc')->get();
        return $messages;
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->room_id = $request->input('room_id', -1);
        $message->user_id = Auth::user()->id;
        $message->content = $request->input('content', '');

        $message->save();

        // Thêm dòng bên dưới
        // Gửi đến các user khác trong phòng TRỪ user tạo tin nhắn này
        broadcast(new MessagePosted($message->load('user')))->toOthers();

        return response()->json(['message' => $message->load('user')]);
    }
}
