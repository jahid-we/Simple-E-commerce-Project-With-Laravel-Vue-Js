<?php

namespace App\Service\product;

use Exception;
use App\Models\Product;
use App\Helper\ResponseHelper;

class productService {

// Get Products By Remark  Start **********************************

public function remarkProduct($request){
    try{
        $data=Product::where('remark',$request->remark)->with('brand','category')->get();
        return ResponseHelper::Out(true,$data,200);
    }catch(Exception $e){
        return ResponseHelper::Out(false,"Failed to get product by remark",500);
    }
}

// Get Products By Remark  End **********************************

// List Products By Category Start **********************************

public function ListProductByCategory($request){
    try{
        $data=Product::where('category_id',$request->categoryId)->with('brand','category')->get();
        return ResponseHelper::Out(true,$data,200);
    }catch(Exception $e){
        return ResponseHelper::Out(false,"Failed to get product by category",500);
    }
}
// List Products By Category End ************************************

// List Products By Brand Start **********************************

public function ListProductByBrand($request){
    try{
        $data=Product::where('brand_id',$request->brandId)->with('brand','category')->get();
        return ResponseHelper::Out(true,$data,200);
    }catch(Exception $e){
        return ResponseHelper::Out(false,"Failed to get product by brand",500);
    }
}
// List Products By Brand End ************************************

}
