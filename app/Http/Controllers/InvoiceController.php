<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SSLCommerz;
use App\Models\CustomerProfile;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\ProductCart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller {
    //invoice create

    public function invoiceCreate(Request $request) {
        DB::beginTransaction();
        try {

            $user_id = $request->header("id");
            $userEmail = $request->header("email");

            $tran_id = uniqid();
            $delivery_status = "pending";
            $payment_status = "pending";

            $profile = CustomerProfile::where('user_id', $user_id)->with('user')->first();
            if ($profile) {
                $customerDetails = "Name:$profile->cus_name,Address:$profile->cus_address,City:$profile->cus_city,Phone:$profile->cus_phone,Email:{$profile->user->email}";
                $shippingDetails = "Name:$profile->ship_name,Address:$profile->ship_address,City:$profile->ship_city,Phone:$profile->ship_phone,Email:{$profile->user->email}";

                //payable calculation
                $total = 0;

                $cartsCount = ProductCart::where("user_id", $user_id)->count();
                if ($cartsCount > 0) {
                    $carts = ProductCart::where("user_id", $user_id)->get();
                    foreach ($carts as $cart) {
                        $total = $total + $cart->price;
                    }

                    $vat = ($total * 3) / 100;
                    $payable = $total + $vat;

                    $invoice = Invoice::create([
                        "total" => $total,
                        "vat" => $vat,
                        "payable" => $payable,
                        "cus_details" => $customerDetails,
                        "ship_details" => $shippingDetails,
                        "tran_id" => $tran_id,
                        "delivery_status" => $delivery_status,
                        "payment_status" => $payment_status,
                        "user_id" => $user_id,
                    ]);

                    $invoiceId = $invoice->id;

                    foreach ($carts as $cart) {
                        InvoiceProduct::create([
                            "invoice_id" => $invoiceId,
                            "product_id" => $cart["product_id"],
                            "user_id" => $user_id,
                            "sale_price" => $cart["price"],
                            "qty" => $cart["qty"],
                        ]);
                    }
                    $paymentMethod = SSLCommerz::InitiatePayment($profile, $payable, $tran_id, $userEmail);
                    ProductCart::where("user_id", $user_id)->delete();
                    DB::commit();
                    return ResponseHelper::Out('success', array(["paymentMethod" => $paymentMethod, "tran_id" => $tran_id, "payable" => $payable, "vat" => $vat, "total" => $total]), 200);
                } else {
                    return ResponseHelper::Out('error', "Cart is empty", 200);
                }

            } else {
                return ResponseHelper::Out('error', "Customer Profile not found", 200);
            }

        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    public function invoiceList(Request $request) {
        try {
            $user_id = $request->header("id");
            $invoiceList = Invoice::where("user_id", $user_id)->get();
            return ResponseHelper::Out('success', $invoiceList, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }
    public function productInvoiceList(Request $request) {
        try {
            $user_id = $request->header("id");
            $invoiceId = $request->invoice_id;
            return InvoiceProduct::where(["invoice_id" => $invoiceId, "user_id" => $user_id])->with("product")->get();
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }

    public function PaymentSuccess(Request $request) {
        return SSLCommerz::InitiateSuccess(["tran_id" => $request->tran_id]);
    }

    public function PaymentFail(Request $request) {
        return SSLCommerz::InitiateFail(["tran_id" => $request->tran_id]);
    }
    public function PaymentCancel(Request $request) {
        return SSLCommerz::InitiateCancle(["tran_id" => $request->tran_id]);
    }
    public function PaymentIPN(Request $request) {
        return SSLCommerz::InitiateIPN($request->input('tran_id'), $request->input('val_id'), $request->input('status'));
    }

}
