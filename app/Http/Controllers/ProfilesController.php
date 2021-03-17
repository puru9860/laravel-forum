<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user)
    {

        return view('profiles.show', [
            'profileUser' => $user,
            'groupedActivities' => Activity::feed($user),
            ])->with([
                'flash' =>json_encode([
                    'type' => 'Success',
                    'body' => 'Reply Added'
            ])]);
    }
}
