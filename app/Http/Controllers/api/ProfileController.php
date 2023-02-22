<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function profile(){
        $user = auth()->guard()->user();
        return ResponseHelper::success(new ProfileResource($user));
    }
}
