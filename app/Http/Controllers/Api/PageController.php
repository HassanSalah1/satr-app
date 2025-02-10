<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return PageResource::collection(Page::latest()->get());
    }

//    public function show(Page $page)
//    {
//        return new PageResource($page);
//    }
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->first();
        if (!$page){
            return $this->errorResponse('Page Not Found', 404);
        }

        return $this->successResponse(null, new PageResource($page));
    }


}
