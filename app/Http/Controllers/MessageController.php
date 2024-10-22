<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MessageController extends Controller
{
    // 使用 AuthorizesRequests 來檢查使用者是否有權限操作某些資源（如留言的更新、刪除）
    use AuthorizesRequests;

    // 取得所有留言，並按照時間倒序排列
    public function index()
    {
        $messages = Message::with('user')->latest()->get();

        // 將取得的留言以 JSON 格式返回給前端
        return response()->json($messages);
    }
    public function myMessages(Request $request)
    {

        // 取得當前登入使用者的留言，並按時間倒序排列
        $messages = $request->user()->messages()->with('user')->latest()->get();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = $request->user()->messages()->create([
            'content' => $request->content,
        ]);

        return response()->json($message, 201);
    }

    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();
        return response()->json(null, 204);
    }

    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message->update([
            'content' => $request->content,
        ]);

        return response()->json($message);
    }
}
