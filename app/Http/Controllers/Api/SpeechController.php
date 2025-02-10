<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SpeechResource;
use App\Models\Speech;
class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows =  SpeechResource::collection(Speech::with('author')->get());
        return $this->successResponse(null, $rows);
    }

    public function show(Speech $speech)
    {
        return new SpeechResource($speech);
    }


}
