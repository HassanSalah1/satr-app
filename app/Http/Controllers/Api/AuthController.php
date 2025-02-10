<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function store(Request $request): JsonResponse
    {

        // Validate request data
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }
        // Store data in the database
         User::create([
            'mobile' => $validator->mobile,
            'password' => Hash::make('password')
        ]);

        return $this->successResponse('Thank you for contacting us!');
    }


}
