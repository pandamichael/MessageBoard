<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // 使用者登入方法，驗證用戶輸入並發送 JWT token 作為回應
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email', // 要求email格式
            'password' => 'required',
        ]);

        // 在資料庫中查找與輸入 email 相符的使用者
        $user = User::where('email', $request->email)->first();

        // 檢查是否找到使用者，並確認密碼是否正確
        if (! $user || ! Hash::check($request->password, $user->password)) {

            // 如果沒有找到使用者或密碼不正確，返回401錯誤（未授權）
            return response()->json([
                'message' => '提供的憑證不正確。'
            ], 401);
        }

         // 如果驗證成功，為該使用者創建一個新的 API token
        $token = $user->createToken('token-name')->plainTextToken;

        // 返回包含 token 的 JSON 回應給客戶端
        return response()->json(['token' => $token]);
    }
}
