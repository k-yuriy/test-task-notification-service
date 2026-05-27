<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PingResource;
use Illuminate\Http\Request;

class PingController extends BaseController
{
    public function ping(Request $request)
    {
        return new PingResource([]);
    }
}
