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
    /**
     * @var DevelopmentService
     */
    private DevelopmentService $developmentService;

    /**
     * DevelopmentController constructor.
     * @param DevelopmentService $developmentService
     */
    public function __construct(DevelopmentService $developmentService)
    {
        $this->developmentService = $developmentService;
    }

    /**
     * @return JsonResponse
     */
    public function getRandomEmailOdDefaultUsers(): JsonResponse
    {
        $email = $this->developmentService->getRandomEmail();

        return response()->json($email);
    }
}
