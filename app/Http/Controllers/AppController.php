<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
    {
        $data = ['user' => Auth::user(), 'rooms' => Chatroom::all()];
        return view('app', ['data' => $data]);
    }
}
