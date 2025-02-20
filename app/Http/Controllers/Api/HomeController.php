<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Spatie\LaravelSettings\Settings;

class HomeController extends Controller
{
    public function setting(GeneralSettings $settings,)
    {
        $data = [
          'app_version' =>   $settings->app_version
        ];
        return $this->successResponse(null, $data);
    }



}
