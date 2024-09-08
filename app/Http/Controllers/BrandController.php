<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Brand;
use Exception;

class BrandController extends Controller {
    //get all brands

    function ByBrandPage() {
        return view('pages.product-by-brand');
    }

    public function index() {
        try {
            $brands = Brand::all();
            return ResponseHelper::Out('success', $brands, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }
}
