<?php

namespace App\Http\Controllers\Development;


use App\Http\Controllers\Controller;
use App\Interfaces\Services\DevelopmentService;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class DevelopmentController extends Controller
{
    public function __construct(
        private DevelopmentService $developmentService
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getRandomEmailOfDefaultUsers(): JsonResponse
    {
        $email = $this->developmentService->getRandomEmail();

        return response()->json($email);
    }
}
