<?php

namespace App\Http\Controllers;

use App\http\Requests\RecommendationRequest;
use App\Services\RecommendationService;
use App\Http\Resources\RecommendationResource;

class RecommendationController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    /**
     * @OA\Get(
     *      path="/api/recommendation",
     *      description="Return all recommendation enabled",
     *      operationId="getAllRecommendation",
     *      tags={"Recommendation"},
     *      summary="Get list recommendation",
     *      description="Returns list of recommendation",
     *      @OA\Response(response=200, description="OK"),
     *      @OA\Response(response=422, description="Missing Data"),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=403, description="Forbidden")
     *     )
     */

    public function index()
    {
        return RecommendationResource::collection($this->recommendationService->get());
    }

     /**
     * @OA\Get(
     *     tags={"Recommendation"},
     *     path="/api/recommendation/{recommendation}",
     *     description="Return recommendation by id - enabled",
     *     @OA\Parameter(
     *         name="recommendation",
     *         in="path",
     *         description="ID recommendation",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(response=200, description="Success."),
     *     @OA\Response(response=422, description="User not found.")
     * )
    */

    public function show($id)
    {
        return RecommendationResource::collection($this->recommendationService->show($id));
    }

    /**
     * @OA\Post(
     *     tags={"Recommendation"},
     *     path="/api/recommendation",
     *     description="Create new recommendation",
     *     @OA\Parameter(
     *         name="user_indicator",
     *         in="query",
     *         description="ID indicator",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="user_indicated",
     *         in="query",
     *         description="ID indicated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Title of book",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(response=201, description="Success."),
     *     @OA\Response(response=422, description="Bad request.")
     * )
    */

    public function store(RecommendationRequest $request)
    {
        return $this->recommendationService->store($request);
    }

    public function update(RecommendationRequest $request, $id)
    {
        return $this->recommendationService->update($request, $id);
    }
    
     /**
     * @OA\Delete(
     *     tags={"Recommendation"},
     *     summary="Delete recommendation by id",
     *     path="/api/recommendation/{id}",
     *     security={{"bearer_token":{}}},
     *     description="Destroy recommendation",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID recommendation",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(response=200, description="Success."),
     *     @OA\Response(response=401, description="permission denied."),
     *     @OA\Response(response=404, description="User not found."),
     *     @OA\Response(response=422, description="Unprocessable Entity."),
     * ),
    */

    public function destroy($id)
    {
        return $this->recommendationService->destroy($id);
    }
}
