<?php

namespace App\Http\Controllers\product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\product\productDetailService;

class productDetailController extends Controller
{
    // productDetailService instance
    protected $productDetail;

    // Constructor to bind productDetailService instance
    public function __construct(productDetailService $productDetail)
    {
        $this->productDetail = $productDetail;
    }


    // Get product detail by product id Start ***********************
    public function ProductDetailsById(Request $request)
    {
        return $this->productDetail->ProductDetailsById($request);
    }
    // Get product detail by product id End *************************

    // Product Detail Creation Start ***************************
    public function ProductDetailCreate(Request $request)
    {
        return $this->productDetail->ProductDetailCreate($request);
    }
    // Product Detail Creation End *****************************

    // Product Detail Update Start *****************************
    public function ProductDetailUpdate(Request $request)
    {
        return $this->productDetail->ProductDetailUpdate($request);
    }
    // Product Detail Update End *******************************

    // Product Detail Delete Start *****************************
    public function ProductDetailDelete(Request $request)
    {
        return $this->productDetail->ProductDetailDelete($request);
    }
    // Product Detail Delete End *******************************
}
