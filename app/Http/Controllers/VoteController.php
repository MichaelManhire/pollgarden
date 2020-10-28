<?php

namespace App\Http\Controllers;

use App\Models\Vote;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Vote::class, 'vote');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        $vote->delete();

        return back();
    }
}
