<?php

namespace App\Http\Controllers;

use App\Traits\ApiAble;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="Subscrition Platform APi", version="1.0")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ApiAble;
}
