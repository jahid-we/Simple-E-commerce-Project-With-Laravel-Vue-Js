<?php

namespace App\Http\Controllers\Page\authPages;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class authPageController extends Controller
{
    // Login Page Method Start ********************************
    public function LoginPage()
    {
        return Inertia::render("authPage/LoginPage");
    }
    // Login Page Method End ********************************

    // Verify Page Method Start ********************************
    public function VerifyPage()
    {
        return Inertia::render("authPage/VerifyUserPage");
    }
    // Verify Page Method End ********************************
}
