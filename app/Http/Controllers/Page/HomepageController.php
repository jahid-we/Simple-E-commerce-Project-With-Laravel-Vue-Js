<?php

namespace App\Http\Controllers\Page;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductSlider;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function HomePage(Request $request){
        $productSlider = ProductSlider::all();
        return Inertia::render("HomePage", ["productSlider"=>$productSlider]);

    }
}
