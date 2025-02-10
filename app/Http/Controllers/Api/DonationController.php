<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DonationResource;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $rows = DonationResource::collection(Donation::get());
        return $this->successResponse(null, $rows);
    }

    public function show(Donation $donation)
    {
        return new DonationResource($donation);
    }
}
