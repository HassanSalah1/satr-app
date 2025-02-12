<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function store(Request $request): JsonResponse
    {

        // Validate request data
        app::setLocale('ar');
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }
        $user = User::where('mobile', $request->mobile)->first();
        if (!$user){
            // Store data in the database
            User::create([
                'mobile' => $request->mobile,
                'password' => Hash::make('password')
            ]);
        }

        $data = ['code' => "0000"];
        return $this->successResponse('Login successfully', $data);
    }
    public function checkCode(Request $request): JsonResponse
    {

        // Validate request data
        app::setLocale('ar');
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:15',
            'code' => 'required|max:6',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }
        if ($request->code != "0000") {
            return $this->errorResponse("الكود غير صحيح", 422);
        }
        $user = User::where('mobile', $request->mobile)->first();


        return $this->successResponse('الكود صحيح');
    }


}
