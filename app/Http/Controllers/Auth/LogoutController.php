<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // 將登出的嘗試記錄到日誌中，記錄登出時的使用者資訊
        Log::info('Logout attempt', ['user' => $request->user()]);

        // 刪除使用者的當前訪問 Token，這表示該用戶的登入狀態將失效
        $request->user()->currentAccessToken()->delete();

        // 返回成功的 JSON 回應，表示使用者已成功登出
        return response()->json(['message' => '已成功登出']);
    }
}
