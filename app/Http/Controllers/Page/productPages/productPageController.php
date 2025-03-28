<?php

namespace App\Http\Controllers\Page\productPages;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class productPageController extends Controller
{
    // Category Page Start ********************************
    public function ByCategory(Request $request){

        $categoryId=$request->query('CategoryId');

        return Inertia::render("productPage/ByCategoryPage",["categoryId"=>$categoryId]);

    }
    // Category Page End **********************************



    // Brand Page Start ********************************
    public function ByBrand(Request $request){

        $brandId=$request->query('BrandId');

        return Inertia::render("productPage/ByBrandPage",["brandId"=>$brandId]);

    }
    // Brand Page End **********************************

    // Product wish list Page Start ********************************
    public function ProductWishList(Request $request){

        return Inertia::render("productPage/ProductWishPage");

    }
    // Product wish list Page End **********************************

    // Product detail Page Start ********************************
    public function ProductDetail(Request $request){

        $productId=$request->query('productId');

        return Inertia::render("productPage/ProductDetailPage",["productId"=>$productId]);

    }
    // Product detail Page End **********************************

    // Product Cart Page Start ********************************
    public function ProductCart(Request $request){

        return Inertia::render("productPage/ProductCartPage");

    }
}
