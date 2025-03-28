<?php

namespace App\Http\Controllers\brand;

use Illuminate\Http\Request;
use App\Service\brand\brandService;
use App\Http\Controllers\Controller;

class brandController extends Controller
{
     // brandService instance
     protected $brand;

     //  Constructor to bind brandService instance

     public function __construct(brandService $brand)
     {
         $this->brand = $brand;
     }

     // Get all brands from the database Start ********************************
     public function getBrands(Request $request)
     {
         return $this->brand->getBrands($request);
     }
     // Get all brands from the database End ********************************


    // Get brand by id from the database Start ********************************
     public function getBrandById(Request $request)
     {
         return $this->brand->getBrandsById($request);
     }
    //  Get brand by id from the database End ********************************


    
     // Add new brand to the database Start ********************************
     public function addBrand(Request $request)
     {
         return $this->brand->addBrand($request);
     }
     // Add new brand to the database End ********************************

     // Update brand to the database Start ********************************
     public function updateBrand(Request $request)
     {
         return $this->brand->updateBrand($request);
     }
     // Update brand to the database End ********************************

     // Delete brand from the database Start ********************************
     public function deleteBrand(Request $request)
     {
         return $this->brand->deleteBrand($request);
     }
     // Delete brand from the database End ********************************
}
