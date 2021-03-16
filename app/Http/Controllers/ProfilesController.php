<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user)
    {

        $activities = $user->activity()->latest()->with('subject')->take(50)->get()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('y-m-d');
            });
        return view('profiles.show', [
            'profileUser' => $user,
            'groupedActivities' => $activities
        ]);
    }
}
