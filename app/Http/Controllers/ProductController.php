<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductDetails;
use App\Models\ProductReview;
use App\Models\ProductSlider;
use App\Models\ProductWish;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller {

    function uniqueBsedOnRemark(Request $request) {
        try {
            $remarks = Product::select('remark')
                ->groupBy('remark')
                ->orderBy('remark', 'asc')
                ->get();
            return ResponseHelper::Out('success', $remarks, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    function productDetailsPage() {
        return view('pages.product-details-page');
    }

    function products() {
        try {
            $products = Product::with('category', 'brand')->get();
            return ResponseHelper::Out('success', $products, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    function ListProductSlider(Request $request) {
        try {
            $productSliders = ProductSlider::all();
            return ResponseHelper::Out('success', $productSliders, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    // product List by category
    function productByCategory(Request $request) {
        try {
            $products = Product::where('category_id', $request->id)->with('category', 'brand')->get();
            return ResponseHelper::Out('success', $products, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    // product List by brand
    function productByBrand(Request $request) {
        try {
            $products = Product::where('brand_id', $request->id)->with('category', 'brand')->get();
            return ResponseHelper::Out('success', $products, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    // product List by remark
    function productByRemark(Request $request) {
        try {
            $products = Product::where('remark', $request->remark)->with('category', 'brand')->get();
            return ResponseHelper::Out('success', $products, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    // product Slider
    function productSlider() {
        try {
            $productSliders = ProductSlider::all();
            return ResponseHelper::Out('success', $productSliders, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    //product details by id
    function productDetailsById(Request $request) {
        try {
            $productDetails = ProductDetails::where('product_id', $request->id)->with('product', 'product.brand', 'product.category')->first();
            return ResponseHelper::Out('success', $productDetails, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    //List Review By Product
    function listReviewByProduct(Request $request) {
        try {
            $reviews = ProductReview::where('product_id', $request->id)->with(['customer' => function ($query) {
                $query->select('id', 'cus_name');
            }])->get();
            return ResponseHelper::Out('success', $reviews, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    public function createProductReview(Request $request) {
        try {
            $user_id = $request->header("id");
            $profile = CustomerProfile::where("user_id", $user_id)->first();
            if ($profile) {
                $request->merge(["customer_id" => $profile->id]);
                $data = ProductReview::updateOrCreate(
                    ['customer_id' => $profile->id, 'product_id' => $request->product_id],
                    $request->input()
                );

                return ResponseHelper::Out('success', $data, 200);
            } else {
                return ResponseHelper::Out('error', "Customer Profile not found", 200);
            }
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    public function createWishList(Request $request) {
        try {
            $user_id = $request->header("id");
            $data = ProductWish::updateOrCreate(
                ['user_id' => $user_id, 'product_id' => $request->product_id],
                ['user_id' => $user_id, 'product_id' => $request->product_id]
            );
            return ResponseHelper::Out('success', $data, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    public function productWishList(Request $request) {
        try {
            $user_id = $request->header("id");
            $data = ProductWish::where('user_id', $user_id)->with('product')->get();
            return ResponseHelper::Out('success', $data, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    public function removeWishList(Request $request) {
        try {
            $user_id = $request->header("id");
            $data = ProductWish::where(["user_id" => $user_id, "product_id" => $request->product_id])->delete();
            return ResponseHelper::Out('success', $data, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    public function createCartList(Request $request) {
        try {
            $user_id = $request->header("id");
            $product_id = $request->product_id;
            $color = $request->color;
            $size = $request->size;
            $qty = $request->qty;
            $unitPrice = 0;

            $product = Product::where("id", $product_id)->first();

            if ($product->discount == 1) {
                $unitPrice = $product->discount_price;
            } else {
                $unitPrice = $product->price;
            }

            $totalPrice = $unitPrice * $qty;
            $data = ProductCart::updateOrCreate(
                ["user_id" => $user_id, "product_id" => $product_id],
                [
                    "user_id" => $user_id,
                    "product_id" => $product_id,
                    "color" => $color,
                    "size" => $size,
                    "qty" => $qty,
                    "price" => $totalPrice,
                ]
            );
            return ResponseHelper::Out('success', $data, 200);

        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    public function cartList(Request $request) {
        try {
            $user_id = $request->header("id");
            $data = ProductCart::where('user_id', $user_id)->with('product')->get();
            return ResponseHelper::Out('success', $data, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    public function removeCartList(Request $request) {
        try {
            $user_id = $request->header("id");
            $data = ProductCart::where(["user_id" => $user_id, "product_id" => $request->id])->delete();
            return ResponseHelper::Out('success', $data, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

}
