<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function homePage()
    {
        $array = DB::table('users')
        ->join('blogs','users.id', '=', 'users_id' )
        ->select('users.id', 'users.name', 'users.email', 'users.images', 'blogs.*')
        ->orderByDesc('blogs.created_at')
        ->paginate(15);

        return view('index', compact('array'));
    }
}
