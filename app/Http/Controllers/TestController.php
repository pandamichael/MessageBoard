<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testAuth()
    {
        return response()->json(['message' => '你已經有登入可以順利使用系統']);
    }
}
