<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    //

    function profilePage() {
        return view('pages.profile-page');
    }

    function createProfile(Request $request) {
        try {

            $userId = $request->header("id");
            $request->merge(["user_id" => $userId]);
            $data = CustomerProfile::updateOrCreate(
                ['user_id' => $userId],
                $request->input()
            );

            return ResponseHelper::Out('success', $data, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 400);
        }
    }

    function readProfile(Request $request) {
        try {
            $userId = $request->header("id");
            $data = CustomerProfile::where('user_id', $userId)->with('user')->first();
            return ResponseHelper::Out('success', $data, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 400);
        }
    }
}
