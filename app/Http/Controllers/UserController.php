<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getMe(Request $request)
    {
//    dump($request);
//    dump(auth()->user());
        return $request->user() ?? 'ne';
    }
}
