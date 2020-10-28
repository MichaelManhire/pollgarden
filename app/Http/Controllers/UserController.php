<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('last_online_at', 'desc')->paginate(30);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $polls = $user->polls()->latest()->paginate(10, ['*'], 'polls_page');
        $votes = $user->votes()->latest()->paginate(10, ['*'], 'votes_page');
        $comments = $user->comments()->latest()->paginate(10, ['*'], 'comments_page');

        return view('users.show', [
            'user' => $user,
            'polls' => $polls,
            'votes' => $votes,
            'comments' => $comments,
        ]);
    }
}
