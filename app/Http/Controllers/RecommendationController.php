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

    public function index()
    {
        return RecommendationResource::collection($this->recommendationService->get());
    }

    public function show($id)
    {
        return RecommendationResource::collection($this->recommendationService->show($id));
    }

    public function store(RecommendationRequest $request)
    {
        return $this->recommendationService->store($request);
    }

    public function destroy($id)
    {
        return $this->recommendationService->destroy($id);
    }
}
