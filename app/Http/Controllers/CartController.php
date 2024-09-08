<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\ProductCart;
use Illuminate\Http\Request;

class CartController extends Controller {
    //

    function cartPage() {
        return view('pages.cart-page');
    }

    function cartCount(Request $request) {
        $user_id = $request->header("id");
        $carts = ProductCart::where("user_id", $user_id)->count();
        return ResponseHelper::Out('success', $carts, 200);
    }
}
