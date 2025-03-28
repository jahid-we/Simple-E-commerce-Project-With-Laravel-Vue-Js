<?php

namespace App\Http\Controllers\product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\product\productService;

class productController extends Controller
{
    // productService instance
    protected $product;

    // Constructor to bind productService instance
    public function __construct(productService $product)
    {
        $this->product = $product;
    }

    // Get all product By Remark Start ***********************

    public function remarkProduct(Request $request)
    {
        return $this->product->remarkProduct($request);
    }

    // Get all product By Remark End ***********************

    //  List product By category Start ***********************

    public function ListProductByCategory(Request $request) {

        return $this->product->ListProductByCategory($request);

    }

    //  List product By category End ***********************


    //  List product By Brand Start ***********************

    public function ListProductByBrand(Request $request) {

        return $this->product->ListProductByBrand($request);

    }
    //  List product By Brand End ***********************
}
