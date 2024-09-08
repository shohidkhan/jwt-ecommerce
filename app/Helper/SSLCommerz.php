<?php
namespace App\Helper;

use App\Models\Invoice;
use App\Models\SslcommerzAccount;
use Exception;
use Illuminate\Support\Facades\Http;

class SSLCommerz {
    static function InitiatePayment($profile, $payable, $tran_id, $userEmail) {
        try {
            $ssl = SslcommerzAccount::first();
            $response = Http::asForm()->post($ssl->init_url, [
                "store_id" => "mycom66cec864be322",
                "store_passwd" => "mycom66cec864be322@ssl",
                "total_amount" => $payable,
                "currency" => "BDT",
                "tran_id" => $tran_id,
                "success_url" => "$ssl->success_url?tran_id=$tran_id",
                "fail_url" => "$ssl->fail_url?tran_id=$tran_id",
                "cancel_url" => "$ssl->cancel_url?tran_id=$tran_id",
                "ipn_url" => $ssl->ipn_url,
                "cus_name" => $profile->cus_name,
                "cus_email" => $userEmail,
                "cus_add1" => $profile->cus_add,
                "cus_add2" => $profile->cus_add,
                "cus_city" => $profile->cus_city,
                "cus_state" => $profile->cus_state,
                "cus_postcode" => $profile->cus_postcode,
                "cus_country" => $profile->cus_country,
                "cus_phone" => $profile->cus_phone,
                "cus_fax" => $profile->cus_fax,
                "shipping_method" => "YES",
                "ship_name" => $profile->ship_name,
                "ship_add1" => $profile->ship_add,
                "ship_add2" => $profile->ship_add,
                "ship_city" => $profile->ship_city,
                "ship_state" => $profile->ship_state,
                "ship_postcode" => $profile->ship_postcode,
                "ship_country" => $profile->ship_country,
                "product_amount" => $payable,
                "product_category" => "Apple Shop Category",
                "product_name" => "Apple Shop Product Name",
            ]);

            return $response->json('desc');

        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 400);
        }
    }

    static function InitiateSuccess($tran_id) {
        Invoice::where(["tran_id" => $tran_id, "val_id" => 0])->update([
            "payment_status" => "Success",
        ]);
        return view("payment.success");
    }
    static function InitiateFail($tran_id) {
        Invoice::where(["tran_id" => $tran_id, "val_id" => 0])->update([
            "payment_status" => "Fail",
        ]);
        return 1;
    }
    static function InitiateCancle($tran_id) {
        Invoice::where(["tran_id" => $tran_id, "val_id" => 0])->update([
            "payment_status" => "Cancle",
        ]);
        return 1;
    }
    static function InitiateIPN($tran_id, $val_id, $status) {
        Invoice::where(["tran_id" => $tran_id, "val_id" => 0])->update([
            "payment_status" => $status,
            "val_id" => $val_id,
        ]);
        return 1;
    }
}