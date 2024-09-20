<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function callHome(){

        $users = User::all();
        $gifts = DB::table('gifts')->get();

        return view('home', compact('users', 'gifts'));
    }
}
