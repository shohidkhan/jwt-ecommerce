<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Policy;
use Exception;
use Illuminate\Http\Request;

class PolicyController extends Controller {
    //

    function policy(Request $request) {
        return view('pages.policy-page');
    }

    function policyByType(Request $request) {
        try {
            $policy = Policy::where('type', '=', $request->type)->first();
            return ResponseHelper::Out('success', $policy, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', $e->getMessage(), 500);
        }
    }
}
