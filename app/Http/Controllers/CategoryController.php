<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    //
    function ByCategoryPage(Request $request) {
        return view('pages.product-by-category');
    }
    function index() {
        try {
            $categories = Category::all();
            return ResponseHelper::Out('success', $categories, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }
}
