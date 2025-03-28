<?php

namespace App\Http\Controllers\Page\userPages;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userProfileController extends Controller
{
    // Get Profile Page
    public function UserProfilePage(Request $request)
    {
        return Inertia::render('userPage/ProfilePage');
    }
}
